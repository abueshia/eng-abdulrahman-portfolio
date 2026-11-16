<?php

/**
 * StatController
 *
 * Thin Admin Controller for managing quantitative portfolio statistics.
 * Delegates all business logic and cache invalidation to StatService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Stat\StoreStatRequest;
use App\Http\Requests\Admin\Stat\UpdateStatRequest;
use App\Models\Stat;
use App\Services\StatService;
use App\ViewModels\StatViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class StatController extends Controller
{
    public function __construct(
        private readonly StatService $statService,
    ) {
        $this->middleware(['auth:admin', 'permission:stats.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:stats.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:stats.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:stats.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:stats.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:stats.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the stats listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Stat::class);

        return view('admin.pages.stat.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the stats table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Stat::class);

        $query = $this->statService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('label->ar', 'like', "%{$search}%")
                    ->orWhere('label->en', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('label', static fn (Stat $stat): string => e((string) $stat->label))
            ->editColumn('value', static fn (Stat $stat): string => e(trim(($stat->prefix ?? '').$stat->value.($stat->suffix ?? ''))))
            ->editColumn('is_active', static fn (Stat $stat): string => $stat->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->addColumn('action', static fn (Stat $stat): string => view('admin.pages.stat.buttons', compact('stat'))->render())
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new stat.
     */
    public function create(): View
    {
        $this->authorize('create', Stat::class);

        return view('admin.pages.stat.form', new StatViewModel);
    }

    /**
     * Store a newly created stat in storage.
     */
    public function store(StoreStatRequest $request): RedirectResponse
    {
        $this->authorize('create', Stat::class);

        $this->statService->create($request->validated());

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.stat.index');
    }

    /**
     * Display the specified stat details.
     */
    public function show(Stat $stat): View
    {
        $this->authorize('view', $stat);

        return view('admin.pages.stat.show', compact('stat'));
    }

    /**
     * Show the form for editing the specified stat.
     */
    public function edit(Stat $stat): View
    {
        $this->authorize('update', $stat);

        return view('admin.pages.stat.form', new StatViewModel($stat));
    }

    /**
     * Update the specified stat in storage.
     */
    public function update(UpdateStatRequest $request, Stat $stat): RedirectResponse
    {
        $this->authorize('update', $stat);

        $this->statService->update($stat, $request->validated());

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.stat.index');
    }

    /**
     * Remove the specified stat from storage.
     */
    public function destroy(Stat $stat): JsonResponse
    {
        $this->authorize('delete', $stat);

        $this->statService->delete($stat);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for stats.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Stat::class);

        $items = $this->statService->getAllForReorder();

        return view('admin.pages.stat.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of stats.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Stat::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->statService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}
