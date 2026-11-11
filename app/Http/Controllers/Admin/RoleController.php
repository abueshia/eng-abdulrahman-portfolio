<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Models\Country;
use App\Models\Permission as ModelsPermission;
use App\Services\RoleService;
use App\ViewModels\RoleViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    private $role;

    public function __construct()
    {
        $this->role = new RoleService();
        // $this->middleware('permission:roles.view_all', ['only' => ['index']]);
        // $this->middleware('permission:roles.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:roles.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:roles.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:roles.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:roles.create'], ['only' => ['create']]);
        $this->middleware(['auth:admin', 'permission:roles.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:roles.delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the category.
     */
    // public function index(Request $request): View
    public function index()
    {

        $roles = Role::paginate(15);
        return view('admin.pages.role.index', compact('roles'));
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Role::query();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Role $role) {
                return $role->id ?? '-';
            })->editColumn('name', function (Role $role) {
                return TransformText($role->name);

            })->editColumn('created_at', function (Role $role) {
                return $role->created_at->format('d-m-Y') ?? '-';

            })->addColumn('action', function (Role $role) {
                return view('admin.pages.role.buttons', compact('role'));
            })
            ->rawColumns(['image', 'action'])
            ->startsWithSearch()
            ->make(true);
    }
    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $role = Role::find($id);
        return view('admin.pages.role.show', get_defined_vars());
    }
    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        $permissions_grouped =
            ModelsPermission::all()
                ->groupBy(function ($permission) {
                    return explode('.', $permission->name)[0]; // Group by the part before the dot
                })
                ->map(function ($group) {
                    return $group->map(function ($permission) {
                        return [
                            'id' => $permission->id,
                            'name' => explode('.', $permission->name)[1] ?? explode('.', $permission->name)[0],
                        ];
                    });
                });
        return view('admin.pages.role.form', new RoleViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['guard'] = 'admin';
        
        $this->role->createRole($data);
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        $permissions_grouped =
            ModelsPermission::all()
                ->groupBy(function ($permission) {
                    return explode('.', $permission->name)[0]; // Group by the part before the dot
                })
                ->map(function ($group) {
                    return $group->map(function ($permission) {
                        return [
                            'id' => $permission->id,
                            'name' => explode('.', $permission->name)[1] ?? explode('.', $permission->name)[0],
                        ];
                    });
                });
        $selected_roles = $role->permissions()->pluck('name')->toArray();

        return view('admin.pages.role.form', new RoleViewModel($role), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, Role $role): RedirectResponse
    {
//        return $request;
        $this->role->updateRole($role, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->role->deleteRole($role);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

    public function reorder(Role $role)
    {
        return $this->role->reorder($role, 'name', 'admin.pages.role.reorder', 1);
    }

    public function saveReorder(Request $request, Role $role)
    {
        $all_entries = \Request::input('tree');
        return $this->role->saveReorder($all_entries, $role);
    }

}
