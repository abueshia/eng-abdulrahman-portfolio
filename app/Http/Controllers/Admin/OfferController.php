<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Offer\OfferRequest;
use App\Models\Branche;
use App\Models\Offer;
use App\Models\Country;
use App\Models\Product;
use App\Models\Region;
use App\Models\Vouchercodeoffer;
use App\Services\OfferService;
use App\ViewModels\OfferViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class OfferController extends Controller
{
    private $offer;

    public function __construct()
    {
        $this->offer = new OfferService();
        //    $this->middleware('permission:cities.view_all', ['only' => ['index']]);
        //    $this->middleware('permission:cities.view_details', ['only' => ['show']]);
        //    $this->middleware('permission:cities.create', ['only' => ['create', 'store']]);
        //    $this->middleware('permission:cities.edit', ['only' => ['edit', 'update']]);
        //    $this->middleware('permission:cities.delete', ['only' => ['destroy']]);
        //    $this->middleware('permission:cities.sort', ['only' => ['reorder', 'saveReorder']]);

        $this->middleware(['auth:admin', 'permission:offer.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:offer.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:offer.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:offer.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:offer.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:offer.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display a listing of the category.
     */
    public function index(Request $request) : View
    {
        //        $offers  = Offer::ordered()->paginate();

        // dd($request);
        $products = Product::get();
        return view('admin.pages.offer.index', get_defined_vars());
    }

    public function ShowVoucherCodeOffer(Request $request): View
    {
        // dd($request);
        $vouchercodeoffer = Vouchercodeoffer::get();
        return view('admin.pages.offer.ShowVoucherCodeOffer', get_defined_vars());
    }
    
    

    public function getOfferByCountry($country)
    {
        $cities = Offer::where('country_id', $country)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function getRegionsByOffer($offer)
    {
        $regions = Region::where('offer_id', $offer)->pluck('name', 'id');

        return response()->json($regions);
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Offer::with(['products'])->orderBy('created_at', 'desc'); // ترتيب حسب created_at من الأحدث إلى الأقدم

        return $dataTables->eloquent($model)->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($search = $request->get('search')['value']) { // البحث باستخدام الاسم
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%")
                        ->orWhereHas('products', function ($q) use ($search) {
                            $q->where('products.name', 'LIKE', "%$search%");
                        });
                    });
                }

                if ($productId = $request->get('product_id')) { // الفلترة حسب المنتج
                    $query->whereHas('products', function ($q) use ($productId) {
                        $q->where('products.id', $productId);
                    });
                }

                if ($createdAt = $request->get('created_at')) { // الفلترة حسب التاريخ
                    $query->whereDate('created_at', '=', $createdAt);
                }
            })
            ->editColumn('id', function (Offer $offer) {
                return $offer->id ?? '-';
            })
            ->editColumn('image', function (Offer $offer) {
                return "<img width='100' src='" . $offer->getFirstMediaUrl('offers') . "' />";
            })
            ->editColumn('name', function (Offer $offer) {
                return $offer->name;
            })
         
            ->editColumn('products', function (Offer $offer) {
                return $offer->products->pluck('name')->implode(', ') ?? '-';
            })

            ->editColumn('discount_number', function (Offer $offer) {
                return $offer->discount_number;
            })

            ->editColumn('point', function (Offer $offer) {
                return '
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-danger decrement-point" data-id="' . $offer->id . '">-</button>
                <span class="mx-2" id="point-' . $offer->id . '">' . $offer->point . '</span>
                <button class="btn btn-sm btn-success increment-point" data-id="' . $offer->id . '">+</button>
            </div>';
            })
            ->editColumn('created_at', function (Offer $offer) {
                return $offer->created_at->format('d-m-Y') ?? '-';
            })
            ->addColumn('action', function (Offer $offer) {
                return view('admin.pages.offer.buttons', compact('offer'));
            })
            ->rawColumns(['image', 'point', 'action'])
            ->startsWithSearch()
            ->make(true);
    }




    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $offer = Offer::with(['products', 'branches'])->find($id);
        return view('admin.pages.offer.show', compact('offer'));
    }


    /**
     * Show the form for creating a new category.
     */
    public function create() : View
    {
        $products = Product::get();
        $branches = Branche::get();
        return view('admin.pages.offer.form' ,  new OfferViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request) : RedirectResponse
    {
        $this->offer->createOffer($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer) : View
    {
        $products = Product::get();
        $branches = Branche::get();
        return view('admin.pages.offer.form' ,  new OfferViewModel($offer), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, Offer $offer) : RedirectResponse
    {
//        return $request;
        $this->offer->updateOffer($offer , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }


    public function updatePoint(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->point = $request->input('point');
        $offer->save();
        return response()->json(['success' => true, 'message' => 'Point updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer) : JsonResponse
    {
        $this->offer->deleteOffer($offer);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

    public function reorder(Offer $offer) {
        return $this->offer->reorder($offer, 'name', 'admin.pages.offer.reorder', 1);
    }

    public function saveReorder(Request $request, Offer $offer) {
        $all_entries = \Request::input('tree');
        return $this->offer->saveReorder($all_entries, $offer);
    }


    
}

