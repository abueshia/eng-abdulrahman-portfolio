<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paymentpicture\PaymentpictureRequest;
use App\Models\Paymentpicture;
use App\Services\PaymentpictureService;
use App\ViewModels\PaymentpictureViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PaymentpictureController extends Controller
{
    private $paymentpicture;

    public function __construct()
    {
        // $this->middleware('permission:payment_picture.view_all', ['only' => ['index']]);
        // $this->middleware('permission:payment_picture.view_details', ['only' => ['show']]);
        // $this->middleware('permission:payment_picture.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:payment_picture.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:payment_picture.delete', ['only' => ['destroy']]);
        // $this->middleware('permission:payment_picture.sort', ['only' => ['reorder', 'saveReorder']]);


        $this->middleware(['auth:admin', 'permission:payment_picture.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:payment_picture.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:payment_picture.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:payment_picture.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:payment_picture.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:payment_picture.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->paymentpicture = new PaymentpictureService();
    }

    /**
     * Display a listing of the paymentpicture.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.paymentpicture.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Paymentpicture::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Paymentpicture $paymentpicture) {
                return $paymentpicture->id ?? '-';
            })
            ->editColumn('name', function (Paymentpicture $paymentpicture) {
                return $paymentpicture->name;
            })
            ->editColumn('image', function (Paymentpicture $paymentpicture) {

                return "<img width='100' src='" . $paymentpicture->getFirstMediaUrl('payment_pictures') . "' />";
            })
            ->editColumn('created_at', function (Paymentpicture $paymentpicture) {
                return $paymentpicture->created_at ? $paymentpicture->created_at->format('d-m-Y h:i A') : '-';
            })
            ->addColumn('action', function (Paymentpicture $paymentpicture) {
                return view('admin.pages.paymentpicture.buttons', compact('paymentpicture'));
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
        $paymentpicture = Paymentpicture::find($id);
        return view('admin.pages.paymentpicture.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new paymentpicture.
     */
    public function create(): View
    {
        return view('admin.pages.paymentpicture.form',  new PaymentpictureViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentpictureRequest $request)
    {
        // return $request;
        $this->paymentpicture->createPaymentpicture($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paymentpicture $paymentpicture): View
    {
        return view('admin.pages.paymentpicture.form',  new PaymentpictureViewModel($paymentpicture));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentpictureRequest $request, Paymentpicture $paymentpicture): RedirectResponse
    {
        //        return $request;
        $this->paymentpicture->updatePaymentpicture($paymentpicture, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paymentpicture $paymentpicture): JsonResponse
    {
        $this->paymentpicture->deletePaymentpicture($paymentpicture);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Paymentpicture $paymentpicture)
    {
        return $this->paymentpicture->reorder($paymentpicture, 'name', 'admin.pages.paymentpicture.reorder', 1);
    }

    public function saveReorder(Request $request, Paymentpicture $paymentpicture)
    {
        $all_entries = $request->input('tree');
        return $this->paymentpicture->saveReorder($all_entries, $paymentpicture);
    }
}
