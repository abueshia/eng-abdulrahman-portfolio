<?php

/**
 * ProjectController
 *
 * Thin Admin Controller for managing portfolio projects and case studies.
 * Delegates all business logic, media uploads, and cache invalidation to ProjectService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreProjectRequest;
use App\Http\Requests\Admin\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use App\ViewModels\ProjectViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService,
    ) {
        $this->middleware(['auth:admin', 'permission:projects.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:projects.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:projects.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:projects.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:projects.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:projects.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the projects listing page.
     */
    public function index(): View
    {
        return view('admin.pages.project.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the projects table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $query = $this->projectService->getAdminDataTableQuery();

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
            ->editColumn('image', static function (Project $project): string {
                $imageUrl = $project->getFirstMediaUrl('projects') ?: asset('dashboard/assets/media/avatars/blank.png');

                return '<img width="65" height="45" style="object-fit:cover;border-radius:6px;" src="'.e($imageUrl).'" alt="'.e((string) $project->title).'"/>';
            })
            ->editColumn('title', static fn (Project $project): string => e((string) $project->title))
            ->addColumn('category', static fn (Project $project): string => e((string) ($project->category?->name ?? '-')))
            ->editColumn('project_type', static function (Project $project): string {
                $type = $project->project_type instanceof ProjectTypeEnum
                    ? $project->project_type
                    : ProjectTypeEnum::tryFrom((string) $project->project_type);

                if ($type === null) {
                    return '-';
                }

                return '<span class="badge badge-light-'.$type->color().'">'.e($type->label()).'</span>';
            })
            ->editColumn('status', static function (Project $project): string {
                $status = $project->status instanceof ProjectStatusEnum
                    ? $project->status
                    : ProjectStatusEnum::tryFrom((string) $project->status);

                if ($status === null) {
                    return '-';
                }

                return '<span class="badge badge-light-'.$status->color().'">'.e($status->label()).'</span>';
            })
            ->editColumn('is_featured', static fn (Project $project): string => $project->is_featured
                ? '<span class="badge badge-light-warning">'.e(TranslationHelper::translate('Featured')).'</span>'
                : '<span class="badge badge-light">'.e(TranslationHelper::translate('Standard')).'</span>')
            ->editColumn('created_at', static fn (Project $project): string => $project->created_at?->format('Y-m-d') ?? '-')
            ->addColumn('action', static fn (Project $project): string => view('admin.pages.project.buttons', compact('project'))->render())
            ->rawColumns(['image', 'project_type', 'status', 'is_featured', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('admin.pages.project.form', new ProjectViewModel);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->projectService->create($request->toDto());

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.project.index');
    }

    /**
     * Display the specified project details.
     */
    public function show(int $id): View
    {
        $project = $this->projectService->findById($id);

        return view('admin.pages.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(int $id): View
    {
        $project = $this->projectService->findById($id);

        return view('admin.pages.project.form', new ProjectViewModel($project));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->projectService->update($project, $request->toDto());

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.project.index');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        $this->projectService->delete($project);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for projects.
     */
    public function reorder(): View
    {
        $items = $this->projectService->getAllForReorder();

        return view('admin.pages.project.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of projects.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->projectService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}

