<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Message\MessageRequest;
use App\Models\Message;
use App\Services\MessageService;
use App\ViewModels\MessageViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{

    public function __construct()
    {

        // $this->middleware('permission:messages.view_all', ['only' => ['index']]);
        // $this->middleware('permission:messages.view_details', ['only' => ['show']]);
        // $this->middleware('permission:messages.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:messages.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:messages.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:messages.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:messages.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:messages.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:messages.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);

    }
    /**
     * Display a listing of the message.
     */
    public function index(Request $request) : View
    {
        return view('admin.pages.message.index');
    }


    
    public function table(DataTables $dataTables, Request $request)
    {
        $model = Message::query();

        // تطبيق التصفية بناءً على القيم المرسلة في الطلب
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];

            $model = $model->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }
        
        if ($request->has('type') && !empty($request->type)) {
            $model = $model->where('type', $request->type);
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Message $message) {
                return $message->id ?? '-';
            })
            ->editColumn('name', function (Message $message) {
                return $message->name ?? '-';
            })
            ->editColumn('email', function (Message $message) {
                return $message->email ?? '-';
            })
            // ->editColumn('city', function (Message $message) {
            //     return $message->city ?? '-';
            // })
            ->editColumn('phone', function (Message $message) {
                return $message->phone ?? '-';
            })
            ->editColumn('type', function (Message $message) {
                if ($message->type == 'booking') {
                    return '<span class="badge badge-light-success">'.\App\Helpers\TranslationHelper::translate('Booking').'</span>';
                }
                return '<span class="badge badge-light-primary">'.\App\Helpers\TranslationHelper::translate('Contact').'</span>';
            })
            ->editColumn('service', function (Message $message) {
                return $message->service ?? '-';
            })
            ->editColumn('created_at', function (Message $message) {
                return $message->created_at ? $message->created_at->format('d-m-Y') : '-';
            })
            ->addColumn('action', function (Message $message) {
                return view('admin.pages.message.buttons', compact('message'));
            })
            ->rawColumns(['action', 'type'])
            ->make(true);
    }


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $message = Message::find($id);
        return view('admin.pages.message.show' , get_defined_vars());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message) : JsonResponse
    {
        $message->delete();
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

}
