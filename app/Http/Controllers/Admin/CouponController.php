<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupon\CouponRequest;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Group;
use App\Models\Product;
use App\Models\Voucherspage;
use App\Services\CouponService;
use App\ViewModels\CouponViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

use Symfony\Component\HttpFoundation\Response; 


class CouponController extends Controller
{
    private $coupon;

    public function __construct()
    {
        $this->middleware(['auth:admin', 'permission:coupon.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:coupon.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:coupon.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:coupon.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:coupon.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:coupon.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->coupon = new CouponService();
    }

    // public function getCityByCountry($city)
    // {
    //     $coupon = Coupon::where('city_id', $city)->pluck('name', 'id');
    //     return response()->json($coupon);
    // }

    
    /**
     * Display a listing of the coupon.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        $groups = Group::all();
        $products = Product::all();
        
        return view('admin.pages.coupon.index' , get_defined_vars());
    }

public function table(DataTables $dataTables, Request $request)
{
    $model = Group::query()->with('coupons'); 

    if ($request->has('name') && $request->name != '') {
        $model->where('name', $request->name); 
    }

    return $dataTables->eloquent($model)
        ->addIndexColumn()

        ->editColumn('name', function ($row) {
            return $row->name; 
        })
            ->editColumn('points', function ($row) {
                return $row->points;
            })
        
        ->addColumn('coupon', function ($row) {
            return $row->coupons->count() ?? 0; 
        })

            ->addColumn('validate_to', function ($row) {
                return $row->validate_to;
            })

        
        ->editColumn('created_at', function ($row) {
            return $row->created_at ? $row->created_at->format('d-m-Y') : '-';
        })
        ->addColumn('is_banned', function ($row) {
      
            return view('admin.pages.coupon.switch', compact('row')); // تمرير الكوبون كاملاً

        })
        ->addColumn('action', function ($row) {
            return view('admin.pages.coupon.buttons', ['model' => $row]); // تمرير الكوبون كاملاً
        })
        ->rawColumns(['action', 'is_banned']) // إضافة is_banned للسماح بعرض الـ Switch Button
        ->make(true);
}


    public function updateStatus($id, Request $request)
    {
        $group = Group::findOrFail($id);
        $group->is_banned = $request->input('is_banned');
        $group->save();

        return response()->json(['success' => true]);
    }



    // public function show($coupon, Request $request)
    // {
    //    $voucherspage = Voucherspage::get();
    //     $group = Group::with('coupons')->findOrFail($coupon); // جلب المجموعة مع الكوبونات

    //     $query = $group->coupons();

    //     if ($request->filled('search')) {
    //         $searchTerm = $request->input('search');
    //         $query->where('code', 'LIKE', '%' . $searchTerm . '%');
    //     }

    //     $coupons = $query->get();

    //     if ($request->has('export')) {
    //         return \Maatwebsite\Excel\Facades\Excel::download(
    //             new \App\Exports\CouponsExport($coupons),
    //             'coupons.xlsx'
    //         );
    //     }
    //     return view('admin.pages.coupon.show', compact('group', 'coupons' , 'voucherspage') );
    // }


    public function show($coupon, Request $request)
    {
        // جلب البيانات الحالية كما هي
        $voucherspage = Voucherspage::with(['client'])->get(); // إضافة علاقة العميل
        $group = Group::with('coupons')->findOrFail($coupon); // جلب المجموعة مع الكوبونات

        $query = $group->coupons();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('code', 'LIKE', '%' . $searchTerm . '%');
        }

        $coupons = $query->get();

        if ($request->has('export')) {
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\CouponsExport($coupons),
                'coupons.xlsx'
            );
        }

        // تمرير البيانات إلى الصفحة مع البيانات الحالية
        return view('admin.pages.coupon.show', compact('group', 'coupons', 'voucherspage'));
    }

 
    public function toggleStatus(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->is_valid = $request->is_valid;
        $coupon->save();
        return response()->json([
            'success' => true,
            'message' => __('Coupon status updated successfully!'),
        ]);
    }
    


    /**
     * Show the form for creating a new coupon.
     */
    public function create(): View
    {
        $groups = Group::all();
        $products = Product::all();

        return view('admin.pages.coupon.form',  new CouponViewModel(), get_defined_vars());
    }


    public function store(CouponRequest $request)
    {
        // dd($request->all()); 
        if (!empty($request->new_group_name)) {
            $group = Group::create([
                'name' => $request->new_group_name,
                'points' => $request->points,
                'validate_to' => $request->validate_to,
            ]);
            $groupId = $group->id;
            dd($group);
        } else {
            $groupId = $request->group_id;
            if (!empty($request->points)) {
                Group::where('id', $groupId)->update(['points' => $request->points]);
            }
            if (!empty($request->validate_to)) {
                Group::where('id', $groupId)->update(['validate_to' => $request->validate_to]);
            }
        }
        $data = $request->validated();
        $data['group_id'] = $groupId;
        if ($request->has('validate_to')) {
            $data['validate_to'] = $request->validate_to;
        }
        $this->coupon->createCoupon($data);
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }


    // public function store(CouponRequest $request)
    // {
    //     // إنشاء أو اختيار الجروب
    //     if (!empty($request->new_group_name)) {
    //         $group = Group::create([
    //             'name' => $request->new_group_name,
    //             'points' => $request->points, // تخزين النقاط للجروب الجديد
    //         ]);
    //         $groupId = $group->id;
    //     } else {
    //         $groupId = $request->group_id;

    //         // تحديث النقاط للجروب المحدد من القائمة
    //         if (!empty($request->points)) {
    //             Group::where('id', $groupId)->update(['points' => $request->points]);
    //         }
    //     }

    //     // إنشاء الأكواد
    //     $data = $request->validated();
    //     $data['group_id'] = $groupId;

    //     $this->coupon->createCoupon($data);

    //     session()->flash('success', TranslationHelper::translate('Operation Success'));
    //     return back();
    // }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon): View
    {
        $groups = Group::all();
        $products = Product::all();
        return view('admin.pages.coupon.form',  new CouponViewModel($coupon), get_defined_vars());
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $this->coupon->updateCoupon($coupon, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon): JsonResponse
    {
        $this->coupon->deleteCoupon($coupon);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Coupon $coupon)
    {
        return $this->coupon->reorder($coupon, 'name', 'admin.pages.coupon.reorder', 1);
    }

    public function saveReorder(Request $request, Coupon $coupon)
    {
        $all_entries = $request->input('tree');
        return $this->coupon->saveReorder($all_entries, $coupon);
    }

    public function changeStatus($id)
    {
        $group = Group::findOrFail($id);
        $group->is_banned = $group->is_banned == 0 ? 1 : 0;
        $group->save();

        return response()->json(['status' => 1, 'msg' => 'تم تحديث الحالة بنجاح', 'data' => [$group->is_banned]]);
    }


    

}
