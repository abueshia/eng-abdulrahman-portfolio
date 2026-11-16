<?php

/**
 * AdminController
 *
 * Manages administrator accounts and their assigned Spatie roles on the `admin` guard.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\Admin\AdminUpdateRequest;
use App\Models\User;
use App\Services\AdminService;
use App\ViewModels\AdminViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct(
        private readonly AdminService $adminService,
    ) {
        $this->middleware(['auth:admin', 'permission:admins.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:admins.view_details'], ['only' => ['show', 'Show']]);
        $this->middleware(['auth:admin', 'permission:admins.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:admins.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:admins.delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of administrator accounts.
     */
    public function index(): View
    {
        $branches = collect();
        $roles = Role::all();

        return view('admin.pages.admin.index', compact('branches', 'roles'));
    }

    /**
     * Return Yajra DataTables JSON for administrators.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $model = User::query();

        if ($request->filled('search_value')) {
            $search = (string) $request->input('search_value');
            $model->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('role_name')) {
            $roleName = (string) $request->input('role_name');
            $model->whereHas('roles', static function ($query) use ($roleName): void {
                $query->where('name', 'like', "%{$roleName}%");
            });
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('role_name', static fn (User $admin): string => (string) ($admin->roles()->first()?->name ?? '-'))
            ->editColumn('branche_name', static fn (): string => '-')
            ->editColumn('created_at', static fn (User $admin): string => $admin->created_at?->format('d-m-Y') ?? '-')
            ->addColumn('action', static fn (User $admin) => view('admin.pages.admin.buttons', compact('admin')))
            ->rawColumns(['image', 'action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Display a single administrator account.
     */
    public function show(int|string $id): View
    {
        $branches = collect();
        $admin = User::query()->findOrFail($id);

        return view('admin.pages.admin.show', compact('branches', 'admin'));
    }

    /**
     * Backward-compatible alias for show().
     */
    public function Show(int|string $id): View
    {
        return $this->show($id);
    }

    /**
     * Show the form for creating a new administrator.
     */
    public function create(): View
    {
        $branches = collect();
        $roles = Role::all();

        return view('admin.pages.admin.form', new AdminViewModel, compact('branches', 'roles'));
    }

    /**
     * Store a newly created administrator in storage.
     */
    public function store(AdminStoreRequest $request): RedirectResponse
    {
        $this->adminService->createAdmin($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return back();
    }

    /**
     * Show the form for editing the specified administrator.
     */
    public function edit(User $admin): View
    {
        $branches = collect();
        $roles = Role::all();

        return view('admin.pages.admin.form', new AdminViewModel($admin), compact('branches', 'roles'));
    }

    /**
     * Update the specified administrator in storage.
     */
    public function update(AdminUpdateRequest $request, User $admin): RedirectResponse
    {
        $this->adminService->updateAdmin($admin, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return back();
    }

    /**
     * Remove the specified administrator from storage.
     */
    public function destroy(User $admin): JsonResponse
    {
        $this->adminService->deleteAdmin($admin);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }
}
