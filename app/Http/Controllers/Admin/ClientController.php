<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\ClientRequest;
use App\Models\Client;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Tag;
use App\Services\ClientService;
use App\ViewModels\ClientViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    private $client;


    

    public function __construct()
    {
        // $this->middleware('permission:clients.view_all', ['only' => ['index']]);
        // $this->middleware('permission:clients.view_details', ['only' => ['show']]);
        // $this->middleware('permission:clients.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:clients.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:clients.delete', ['only' => ['destroy']]);
         
        $this->middleware(['auth:admin', 'permission:client.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:client.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:client.create'], ['only' => ['create', 'update']]);
        $this->middleware(['auth:admin', 'permission:client.edit'], ['only' => ['edit', 'store']]);
        $this->middleware(['auth:admin', 'permission:client.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:client.sort'], ['only' => ['reorder', 'saveReorder']]);
        $this->client = new ClientService();
    }
 
    /**
     * 
     * 
     * Display a listing of the client.
     */
    public function index(Request $request): View
    {
        $cities = City::get();
        return view('admin.pages.client.index' , get_defined_vars() );
    }





    public function table(DataTables $dataTables, Request $request)
    {
        $model = Client::with('city')
        ->orderBy('id', 'desc');

        // فلترة الاسم أو الكارد
        $model = $model->when($request->get('search_value'), function ($query, $search_value) {
            $query->where(function ($q) use ($search_value) {
                $q->where('name', 'LIKE', '%' . $search_value . '%')
                    ->orWhere('card', 'LIKE', '%' . $search_value . '%');
            });
        });

        $model = $model->when($request->get('category'), function ($query, $category) {
            $query->where('category', $category);
        })
        ->when($request->get('city_name'), function ($query, $city_name) {
            $query->whereHas('city', function ($q) use ($city_name) {
                $q->where('name', 'LIKE', '%' . $city_name . '%');
            });
        })
        ->when($request->get('created_at'), function ($query, $created_at) {
            $query->whereDate('created_at', $created_at);
        });

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('city_name', function (Client $client) {
                return $client->city->name ?? '-';
            })
            ->editColumn('card', function (Client $client) {
                return $client->card ?? '-';
            })
            ->editColumn('category', function (Client $client) {
                return match ($client->category) {
                    'gold' => 'Gold (High)',
                    'silver' => 'Silver (Medium)',
                    'bronze' => 'Bronze (Low)',
                    default => '-',
                };
            })
            ->editColumn('created_at', function (Client $client) {
                return $client->created_at ? $client->created_at->format('d-m-Y') : '-';
            })
            ->addColumn('is_active', function (Client $client) {
                return $client->is_active
                    ? '<label class="switch"><input type="checkbox" class="active-toggle" data-id="' . $client->id . '" checked><span class="slider round"></span></label>'
                    : '<label class="switch"><input type="checkbox" class="active-toggle" data-id="' . $client->id . '"><span class="slider round"></span></label>';
            })
            ->addColumn('ban', function (Client $client) {
                return $client->is_banned
                    ? '<label class="switch"><input type="checkbox" class="ban-toggle" data-id="' . $client->id . '" checked><span class="slider round"></span></label>'
                    : '<label class="switch"><input type="checkbox" class="ban-toggle" data-id="' . $client->id . '"><span class="slider round"></span></label>';
            })
            ->addColumn('action', function (Client $client) {
                return view('admin.pages.client.buttons', compact('client'))->render();
            })
            ->rawColumns(['ban', 'action', 'is_active'])
            ->make(true);
    }


    public function showPoints($id)
    {
        $clients = Client::find($id);
        return view('admin.pages.client.showpoints', get_defined_vars());
    }


    public function Show($id): View
    {
        $client = Client::find($id);
        $cities = City::get();
        $regions = Region::get();
        $countries = Country::get();
        return view('admin.pages.client.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new client.
     */
    public function create(): View
    {
        $cities = City::get();
        $regions = Region::get();
        $countries = Country::get();
        return view('admin.pages.client.form',  new ClientViewModel(), get_defined_vars());
    }

    // public function createpoints($id): View
    // {
    //     $client = Client::find($id);
    //     return view('admin.pages.client.form_points',  new ClientViewModel(), get_defined_vars());
    // }

    public function createpoints($id): View
    {
        $client = Client::findOrFail($id); // تأكد من الحصول على العميل أو أرسل 404
        return view('admin.pages.client.form_points', compact('client'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        // return $request;
        $this->client->createClient($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    public function storePoints(Request $request, $id)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'points' => 'required|integer|min:1',
        ], [
            'points.required' => 'النقاط مطلوبة.',
            'points.integer' => 'النقاط يجب أن تكون عددًا صحيحًا.',
            'points.min' => 'يجب أن تكون النقاط على الأقل 1.',
        ]);

        // العثور على العميل بناءً على الـ ID
        $client = Client::findOrFail($id);

        // تحويل النقاط إلى عدد صحيح قبل جمعها
        $client->points = (int) $client->points; // تأكد من أن النقاط عدد صحيح

        // إضافة النقاط إلى العميل
        $client->points += $request->input('points');
        $client->save();

        // تعيين رسالة نجاح بعد إضافة النقاط
        session()->flash('success', TranslationHelper::translate('Operation Success'));

        // إرجاع المستخدم إلى نفس الصفحة مع الرسالة
        return back();
    }


    public function toggleActiveStatus(Request $request)
    {
        $client = Client::findOrFail($request->id); 

        $client->is_active = !$client->is_active;

        $client->save();

        return response()->json(['success' => true, 'is_active' => $client->is_active]);
    }


    public function ban(Request $request)
    {
        try {
            $client = Client::findOrFail($request->id);
            $client->update(['is_banned' => $request->is_banned]);

            return response()->json([
                'success' => true,
                'message' => $request->is_banned ? 'تم حظر العميل بنجاح.' : 'تم إلغاء حظر العميل بنجاح.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث حالة العميل.'
            ]);
        }
    }

    public function getRegions($cityId)
    {
        $regions = Region::where('city_id', $cityId)->get();

        return response()->json([
            'regions' => $regions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): View
    {
        $cities = City::get();
        $regions = Region::get();
        $countries = Country::get();
        return view('admin.pages.client.form',  new ClientViewModel($client), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
            //    return $request;
        $this->client->updateClient($client, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): JsonResponse
    {
        $this->client->deleteClient($client);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }


    public function reorder(Client $client)
    {
        return $this->client->reorder($client, 'name', 'admin.pages.client.reorder', 1);
    }

    public function saveReorder(Request $request, Client $client)
    {
        $all_entries = $request->input('tree');
        return $this->client->saveReorder($all_entries, $client);
    }

}
