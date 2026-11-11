<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\GroupRequest;
use App\Models\Group;
use App\Services\GroupService;
use App\ViewModels\GroupViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class GroupController extends Controller
{
    private $group;

    public function __construct()
    {
        // $this->middleware('permission:group_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:group_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:group_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:group_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:group_us.delete', ['only' => ['destroy']]);

      
        $this->middleware(['auth:admin', 'permission:group.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:group.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:group.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:group.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:group.delete'], ['only' => ['destroy']]);
        $this->group = new GroupService();
    }

    /**
     * Display a listing of the group.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.group.index');
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Group::ordered();
        // dd($model->get());
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Group $group) {
                return $group->id ?? '-';
                
            })->editColumn('image', function (Group $group) {
                return "<img width='100' src=' " . $group->getFirstMediaUrl('groups') . " '/>";
                
            })->editColumn('name', function (Group $group) {
                return $group->name;
            })->editColumn('created_at', function (Group $group) {
                return $group->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Group $group) {
                return view('admin.pages.group.buttons', compact('group'));
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
        $group = Group::find($id);
        return view('admin.pages.group.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new group.
     */
    public function create(): View
    {
        return view('admin.pages.group.form',  new GroupViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        // return $request;
        $this->group->createGroup($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }
    public function storeAjax(Request $request)
    {
        if($request->has('name') && $request->name != '') {
            // Save Group Name
            $new_group = Group::create([
                'name' => $request->name
            ]);
            return response()->json(['status' => 1, 'msg' => TranslationHelper::translate('Operation Success'), 'data' => $new_group ]);
        } else {
            return response()->json(['status' => 0, 'msg' => TranslationHelper::translate('Operation Failed'), 'data' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group): View
    {
        return view('admin.pages.group.form',  new GroupViewModel($group));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group): RedirectResponse
    {
        //        return $request;
        $this->group->updateGroup($group, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): JsonResponse
    {
        $this->group->deleteGroup($group);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Group $group)
    {
        return $this->group->reorder($group, 'name', 'admin.pages.group.reorder', 1);
    }

    public function saveReorder(Request $request, Group $group)
    {
        $all_entries = $request->input('tree');
        return $this->group->saveReorder($all_entries, $group);
    }
}
