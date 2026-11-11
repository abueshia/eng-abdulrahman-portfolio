<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str; 

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Privacypolicy\PrivacypolicynowRequest;
use App\Http\Requests\Admin\Privacypolicy\PrivacypolicyRequest;
use App\Models\Privacypolicy;
use App\Services\PrivacypolicyService;
use App\ViewModels\PrivacypolicyViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PrivacypolicyController extends Controller
{
    private $privacypolicy;

    public function __construct()
    {
        // $this->middleware('permission:privacypolicy.view_all', ['only' => ['index']]);
        // $this->middleware('permission:privacypolicy.view_details', ['only' => ['show']]);
        // $this->middleware('permission:privacypolicy.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:privacypolicy.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:privacypolicy.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:privacypolicy.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:privacypolicy.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:privacypolicy.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:privacypolicy.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:privacypolicy.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:privacypolicy.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->privacypolicy = new PrivacypolicyService();
    }

    /**
     * Display a listing of the privacypolicy.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.privacypolicy.index');
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Privacypolicy::query();

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];

            $model = $model->where('name', 'LIKE', '%' . $search . '%');
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Privacypolicy $privacypolicy) {
                return $privacypolicy->id ?? '-';
            })
            ->editColumn('name', function (Privacypolicy $privacypolicy) {
                return $privacypolicy->name ?? '-';
            })

            ->editColumn('description', function (Privacypolicy $privacypolicy) {
                // اختصار الوصف إلى 150 حرفًا إذا كان موجودًا
                return $privacypolicy->description
                    ? Str::limit(strip_tags($privacypolicy->description), 100, '...')
                    : '-';
            })
            ->editColumn('created_at', function (Privacypolicy $privacypolicy) {
                return $privacypolicy->created_at ? $privacypolicy->created_at->format('d-m-Y') : '-';
            })
            ->addColumn('action', function (Privacypolicy $privacypolicy) {
                return view('admin.pages.privacypolicy.buttons', compact('privacypolicy'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $privacypolicy = Privacypolicy::find($id);
        return view('admin.pages.privacypolicy.show', get_defined_vars());
    }

    
    /**
     * Show the form for creating a new privacypolicy.
     */
    public function create(): View
    {
        return view('admin.pages.privacypolicy.form',  new PrivacypolicyViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrivacypolicynowRequest $request)
    {
        // return $request;
        $this->privacypolicy->createPrivacypolicy($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }


    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Privacypolicy $privacypolicy): View
    {
        return view('admin.pages.privacypolicy.form',  new PrivacypolicyViewModel($privacypolicy));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(PrivacypolicynowRequest $request, Privacypolicy $privacypolicy): RedirectResponse
    {
        //        return $request;
        $this->privacypolicy->updatePrivacypolicy($privacypolicy, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Privacypolicy $privacypolicy): JsonResponse
    {
        $this->privacypolicy->deletePrivacypolicy($privacypolicy);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Privacypolicy $privacypolicy)
    {
        return $this->privacypolicy->reorder($privacypolicy, 'name', 'admin.pages.privacypolicy.reorder', 1);
    }

    public function saveReorder(Request $request, Privacypolicy $privacypolicy)
    {
        $all_entries = $request->input('tree');
        return $this->privacypolicy->saveReorder($all_entries, $privacypolicy);
    }
}
