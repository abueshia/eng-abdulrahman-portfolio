<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Testimonial\TestimonialRequest;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use App\ViewModels\TestimonialViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{
    private $testimonial;

    public function __construct()
    {
        // $this->middleware('permission:testimonial.view_all', ['only' => ['index']]);
        // $this->middleware('permission:testimonial.view_details', ['only' => ['show']]);
        // $this->middleware('permission:testimonial.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:testimonial.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:testimonial.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:testimonial.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:testimonial.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:testimonial.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:testimonial.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:testimonial.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:testimonial.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->testimonial = new TestimonialService();
    }

    /**
     * Display a listing of the testimonial.
     */
    public function index(Request $request): View
    {
        $total_reviews = Testimonial::count();
        $average_rating = Testimonial::avg('rating') ?? 0;
        
        return view('admin.pages.testimonial.index', compact('total_reviews', 'average_rating'));
    }

    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Testimonial::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Testimonial $testimonial) {
    //             return $testimonial->id ?? '-';
    //         })->editColumn('name', function (Testimonial $testimonial) {
    //             return $testimonial->name;
    //         })->editColumn('name_job', function (Testimonial $testimonial) {
    //             return "<img width='100' src=' " . $testimonial->getFirstMediaUrl('testimonials') . " '/>";
    //         })->editColumn('created_at', function (Testimonial $testimonial) {
    //             return $testimonial->created_at->format('d-m-Y h:i A') ?? '-';
    //         })->addColumn('action', function (Testimonial $testimonial) {
    //             return view('admin.pages.testimonial.buttons', compact('testimonial'));
    //         })
    //         ->rawColumns(['image', 'action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }
    public function table(DataTables $dataTables, Request $request)
    {
        $model = Testimonial::query();

        // إذا كان هناك طلب بحث عام
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];

            // البحث في حقل الاسم فقط
            $model = $model->where('name', 'LIKE', '%' . $search . '%');
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Testimonial $testimonial) {
                return $testimonial->id ?? '-';
            })
            ->editColumn('name', function (Testimonial $testimonial) {
                return $testimonial->name ?? '-';
            })
            ->editColumn('description', function (Testimonial $testimonial) {
                return \Illuminate\Support\Str::limit($testimonial->description, 50, '...') ?? '-';
            })
            ->editColumn('rating', function (Testimonial $testimonial) {
                $stars = '';
                for ($i = 0; $i < $testimonial->rating; $i++) {
                    $stars .= '<i class="fa-solid fa-star text-warning"></i>';
                }
                return $stars;
            })
            ->editColumn('created_at', function (Testimonial $testimonial) {
                return $testimonial->created_at ? $testimonial->created_at->format('d-m-Y h:i A') : '-';
            })
            ->addColumn('action', function (Testimonial $testimonial) {
                return view('admin.pages.testimonial.buttons', compact('testimonial'));
            })
            ->rawColumns(['action', 'rating'])
            ->make(true);
    }





    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $testimonial = Testimonial::find($id);
        return view('admin.pages.testimonial.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create(): View
    {
        return view('admin.pages.testimonial.form',  new TestimonialViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        // return $request;
        $this->testimonial->createTestimonial($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('admin.pages.testimonial.form',  new TestimonialViewModel($testimonial));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        //        return $request;
        $this->testimonial->updateTestimonial($testimonial, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $this->testimonial->deleteTestimonial($testimonial);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Testimonial $testimonial)
    {
        return $this->testimonial->reorder($testimonial, 'name', 'admin.pages.testimonial.reorder', 1);
    }

    public function saveReorder(Request $request, Testimonial $testimonial)
    {
        $all_entries = $request->input('tree');
        return $this->testimonial->saveReorder($all_entries, $testimonial);
    }
}
