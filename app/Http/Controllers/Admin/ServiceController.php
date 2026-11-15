<?php

/**
 * ServiceController
 *
 * Thin Admin Controller for managing software engineering services.
 * Delegates all business logic, media uploads, and cache invalidation to ServiceCatalogService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Http\Requests\Admin\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Services\ServiceCatalogService;
use App\ViewModels\ServiceViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    public function __construct(
        private readonly ServiceCatalogService $serviceCatalogService,
    ) {
        $this->middleware(['auth:admin', 'permission:services.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:services.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:services.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:services.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:services.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:services.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the services listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Service::class);

        return view('admin.pages.service.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the services table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Service::class);

        $query = $this->serviceCatalogService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('title->ar', 'like', "%{$search}%")
                    ->orWhere('title->en', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('image', static function (Service $service): string {
                $imageUrl = $service->getFirstMediaUrl('services');
                if ($imageUrl !== '') {
                    return '<img width="48" height="48" style="object-fit:cover;border-radius:6px;" src="'.e($imageUrl).'" alt="'.e((string) $service->title).'"/>';
                }

                if (! empty($service->icon)) {
                    return '<i class="'.e((string) $service->icon).' fs-2 text-primary"></i>';
                }

                return '-';
            })
            ->editColumn('title', static fn (Service $service): string => e((string) $service->title))
            ->editColumn('is_featured', static fn (Service $service): string => $service->is_featured
                ? '<span class="badge badge-light-warning">'.e(TranslationHelper::translate('Featured')).'</span>'
                : '<span class="badge badge-light">'.e(TranslationHelper::translate('Standard')).'</span>')
            ->editColumn('is_active', static fn (Service $service): string => $service->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->addColumn('action', static fn (Service $service): string => view('admin.pages.service.buttons', compact('service'))->render())
            ->rawColumns(['image', 'is_featured', 'is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        $this->authorize('create', Service::class);

        return view('admin.pages.service.form', new ServiceViewModel);
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $this->authorize('create', Service::class);

        $this->serviceCatalogService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.service.index');
    }

    /**
     * Display the specified service details.
     */
    public function show(Service $service): View
    {
        $this->authorize('view', $service);
        $service->load('media');

        return view('admin.pages.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): View
    {
        $this->authorize('update', $service);
        $service->load('media');

        return view('admin.pages.service.form', new ServiceViewModel($service));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $this->authorize('update', $service);

        $this->serviceCatalogService->update($service, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.service.index');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service): JsonResponse
    {
        $this->authorize('delete', $service);

        $this->serviceCatalogService->delete($service);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for services.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Service::class);

        $items = $this->serviceCatalogService->getAllForReorder();

        return view('admin.pages.service.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of services.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Service::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->serviceCatalogService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}

