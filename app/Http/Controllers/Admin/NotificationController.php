<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\NotificationRequest;
use App\Models\Client;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationService;
use App\ViewModels\NotificationViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class NotificationController extends Controller
{
    private $notification;

    public function __construct()
    {
        // $this->middleware('permission:notification_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:notification_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:notification_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:notification_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:notification_us.delete', ['only' => ['destroy']]);
      
        $this->middleware(['auth:admin', 'permission:notification.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:notification.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:notification.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:notification.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:notification.delete'], ['only' => ['destroy']]);
        $this->notification = new NotificationService();
    }

    /**
     * Display a listing of the notification.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.notification.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Notification::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Notification $notification) {
                return $notification->id ?? '-';
                
            })->editColumn('image', function (Notification $notification) {
                return "<img width='100' src=' " . $notification->getFirstMediaUrl('notifications') . " '/>";
                
            })->editColumn('title', function (Notification $notification) {
                return $notification->title;
            })->editColumn('created_at', function (Notification $notification) {
                return $notification->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Notification $notification) {
                return view('admin.pages.notification.buttons', compact('notification'));
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
        $notification = Notification::find($id);
        return view('admin.pages.notification.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new notification.
     */
    // public function create(): View
    // {
    //     $users =User::get();
    //      return view('admin.pages.notification.form',  new NotificationViewModel(), get_defined_vars());
    // }

public function create(): View
{
    $users = Client::get();
      return view('admin.pages.notification.form',  new NotificationViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(NotificationRequest $request)
    // {
    //     // return $request;
    //     $this->notification->createNotification($request->validated());
    //     session()->flash('success', TranslationHelper::translate('Operation Success'));
    //     return back();
    // }

    //   public function store(NotificationRequest $request)
    // {
    //     $data = $request->validated();
    //     if ($data['user_id'] === 'all') {
    //         unset($data['user_id']);
    //     }
    //     $this->notification->createNotification($data);
    //     session()->flash('success', TranslationHelper::translate('Operation Success'));
    //     return back();
    // }

    public function store(NotificationRequest $request)
    {

        // dd($request);
        

        $data = $request->validated();

        if ($data['user_id'] == 'all') {
            $clients = Client::get();
            $title = $data['name'];
            $body = $data['message'];
            $payload = [];
            $notification = new NotificationService();
                   
                        $notification->sendNotifications($clients->pluck('fcm_token')->toArray(), $title, $body, $payload);

                        $notification->createNotifications($title, $body, $payload, $clients->pluck('id'));

                    
              

                // $data['user_id'] = $client->id;
                // $this->notification->createNotification($data);
          
        } else {
            $client = Client::select('id', 'fcm_token')->find($data['user_id']);

            $token = $client->fcm_token;

            $title = $data['name'];
            $body = $data['message'];
            $payload = [];
            try {
                if ($token != null) {
                    $notification = new NotificationService();

                 
                    // $notification->createNotification($title, $body, $payload, $client->id);

                    $notification->sendNotification($token, $title, $body);
                } else {
                    Log::error('The User With Id : ' . $client->id . ' Has No FCM Token');
                }
            } catch (\Exception $exception) {
                Log::error($exception);
            }

            $this->notification->createNotification($title, $body, $payload, $client->id);
        }

        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification): View
    {
        return view('admin.pages.notification.form',  new NotificationViewModel($notification));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotificationRequest $request, Notification $notification): RedirectResponse
    {
        //        return $request;
        $this->notification->updateNotification($notification, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $this->notification->deleteNotification($notification);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Notification $notification)
    {
        return $this->notification->reorder($notification, 'name', 'admin.pages.notification.reorder', 1);
    }

    public function saveReorder(Request $request, Notification $notification)
    {
        $all_entries = $request->input('tree');
        return $this->notification->saveReorder($all_entries, $notification);
    }
}
