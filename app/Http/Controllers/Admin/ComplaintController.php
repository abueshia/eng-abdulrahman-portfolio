<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Complaint\ComplaintRequest;
use App\Models\Complaint;
use App\Services\ComplaintService;
use App\ViewModels\ComplaintViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ComplaintController extends Controller
{
    private $complaint;

    public function __construct()
    {
        // $this->middleware('permission:complaint_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:complaint_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:complaint_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:complaint_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:complaint_us.delete', ['only' => ['destroy']]);

      
        $this->middleware(['auth:admin', 'permission:complaint.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:complaint.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:complaint.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:complaint.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:complaint.delete'], ['only' => ['destroy']]);
        $this->complaint = new ComplaintService();
    }

    /**
     * Display a listing of the complaint.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.complaint.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Complaint::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Complaint $complaint) {
                return $complaint->id ?? '-';
                
            })->editColumn('image', function (Complaint $complaint) {
                return "<img width='100' src=' " . $complaint->getFirstMediaUrl('complaints') . " '/>";
                
            })->editColumn('name', function (Complaint $complaint) {
                return $complaint->name;

        })->editColumn('email', function (Complaint $complaint) {
            return $complaint->email;

        })->editColumn('phone', function (Complaint $complaint) {
            return $complaint->phone;
            
            })->editColumn('created_at', function (Complaint $complaint) {
                return $complaint->created_at->format('d-m-Y') ?? '-';
            })->addColumn('action', function (Complaint $complaint) {
                return view('admin.pages.complaint.buttons', compact('complaint'));
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
        $complaint = Complaint::find($id);
        return view('admin.pages.complaint.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new complaint.
     */
    public function create(): View
    {
        return view('admin.pages.complaint.form',  new ComplaintViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintRequest $request)
    {
        // return $request;
        $this->complaint->createComplaint($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint): View
    {
        return view('admin.pages.complaint.form',  new ComplaintViewModel($complaint));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintRequest $request, Complaint $complaint): RedirectResponse
    {
        //        return $request;
        $this->complaint->updateComplaint($complaint, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint): JsonResponse
    {
        $this->complaint->deleteComplaint($complaint);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Complaint $complaint)
    {
        return $this->complaint->reorder($complaint, 'name', 'admin.pages.complaint.reorder', 1);
    }

    public function saveReorder(Request $request, Complaint $complaint)
    {
        $all_entries = $request->input('tree');
        return $this->complaint->saveReorder($all_entries, $complaint);
    }
}
