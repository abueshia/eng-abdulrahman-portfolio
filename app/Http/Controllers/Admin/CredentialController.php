<?php

/**
 * CredentialController
 *
 * Thin Admin Controller for managing academic degrees, certifications, courses, and awards.
 * Delegates all business logic, media uploads, and cache invalidation to CredentialService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\CredentialTypeEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Credential\StoreCredentialRequest;
use App\Http\Requests\Admin\Credential\UpdateCredentialRequest;
use App\Models\Credential;
use App\Services\CredentialService;
use App\ViewModels\CredentialViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CredentialController extends Controller
{
    public function __construct(
        private readonly CredentialService $credentialService,
    ) {
        $this->middleware(['auth:admin', 'permission:credentials.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:credentials.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:credentials.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:credentials.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:credentials.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:credentials.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the credentials listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Credential::class);

        return view('admin.pages.credential.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the credentials table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Credential::class);

        $query = $this->credentialService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('title->ar', 'like', "%{$search}%")
                    ->orWhere('title->en', 'like', "%{$search}%")
                    ->orWhere('organization->ar', 'like', "%{$search}%")
                    ->orWhere('organization->en', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('title', static fn (Credential $credential): string => e((string) $credential->title))
            ->editColumn('organization', static fn (Credential $credential): string => e((string) $credential->organization))
            ->editColumn('type', static function (Credential $credential): string {
                $type = $credential->type instanceof CredentialTypeEnum
                    ? $credential->type
                    : CredentialTypeEnum::tryFrom((string) $credential->type);

                if ($type === null) {
                    return '-';
                }

                return '<span class="badge badge-light-'.$type->color().'">'.e($type->label()).'</span>';
            })
            ->editColumn('issued_at', static fn (Credential $credential): string => $credential->issued_at?->format('Y-m-d') ?? '-')
            ->editColumn('is_active', static fn (Credential $credential): string => $credential->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->addColumn('action', static fn (Credential $credential): string => view('admin.pages.credential.buttons', compact('credential'))->render())
            ->rawColumns(['type', 'is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new credential.
     */
    public function create(): View
    {
        $this->authorize('create', Credential::class);

        return view('admin.pages.credential.form', new CredentialViewModel);
    }

    /**
     * Store a newly created credential in storage.
     */
    public function store(StoreCredentialRequest $request): RedirectResponse
    {
        $this->authorize('create', Credential::class);

        $this->credentialService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.credential.index');
    }

    /**
     * Display the specified credential details.
     */
    public function show(Credential $credential): View
    {
        $this->authorize('view', $credential);
        $credential->load('media');

        return view('admin.pages.credential.show', compact('credential'));
    }

    /**
     * Show the form for editing the specified credential.
     */
    public function edit(Credential $credential): View
    {
        $this->authorize('update', $credential);
        $credential->load('media');

        return view('admin.pages.credential.form', new CredentialViewModel($credential));
    }

    /**
     * Update the specified credential in storage.
     */
    public function update(UpdateCredentialRequest $request, Credential $credential): RedirectResponse
    {
        $this->authorize('update', $credential);

        $this->credentialService->update($credential, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.credential.index');
    }

    /**
     * Remove the specified credential from storage.
     */
    public function destroy(Credential $credential): JsonResponse
    {
        $this->authorize('delete', $credential);

        $this->credentialService->delete($credential);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for credentials.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Credential::class);

        $items = $this->credentialService->getAllForReorder();

        return view('admin.pages.credential.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of credentials.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Credential::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->credentialService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}
