<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\About\AboutRequest;
use App\Models\About;
use App\Services\AboutService;
use App\ViewModels\AboutViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AboutController extends Controller
{
    private $about;

    public function __construct()
    {
        $this->middleware(['auth:admin', 'permission:about_us.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:about_us.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:about_us.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:about_us.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:about_us.delete'], ['only' => ['destroy']]);
        $this->about = new AboutService();
    }

    /**
     * Display a listing of the about.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.about.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = About::query();
        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (About $about) {
                return $about->id ?? '-';
            })
      
            ->editColumn('title', function (About $about) {
                return $about->title;
            })
            ->editColumn('created_at', function (About $about) {
                return $about->created_at->format('d-m-Y') ?? '-';
            })
            ->addColumn('action', function (About $about) {
                return view('admin.pages.about.buttons', compact('about'));
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
        $about = About::find($id);
        return view('admin.pages.about.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new about.
     */
    public function create(): View
    {
        return view('admin.pages.about.form',  new AboutViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        // return $request;
        $this->about->createAbout($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about): View
    {
        return view('admin.pages.about.form',  new AboutViewModel($about));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about): RedirectResponse
    {
        //        return $request;
        $this->about->updateAbout($about, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about): JsonResponse
    {
        $this->about->deleteAbout($about);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(About $about)
    {
        return $this->about->reorder($about, 'name', 'admin.pages.about.reorder', 1);
    }

    public function saveReorder(Request $request, About $about)
    {
        $all_entries = $request->input('tree');
        return $this->about->saveReorder($all_entries, $about);
    }
}
