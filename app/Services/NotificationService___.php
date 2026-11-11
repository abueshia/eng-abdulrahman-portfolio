<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Client;
use App\Models\Notification;

class  NotificationService
{

    // public function createNotification($data)
    // {
    //  {
    //     // dd($data);
    //         $notification = Notification::create($data);
    //     }
    //     if (isset($data['meta_image'])) {
    //         $notification->storeFile($data['meta_image'], '_meta_image');
    //     }
    // }



    // public function createNotification($data)
    // {
    //     $notification = Notification::create([
    //         'name' => $data['name'], 
    //         'message' => $data['message'], 
    //         'user_id' => $data['user_id'] ?? null, 
    //     ]);

    // }

    public function createNotification($data)
    {
        // إنشاء الإشعار وحفظه في قاعدة البيانات
        $notification = Notification::create([
            'name' => $data['name'] ?? 'Default Name', // توفير قيمة افتراضية
            'message' => $data['message'] ?? 'Default Message', // توفير قيمة افتراضية
            'user_id' => $data['user_id'] ?? null, // توفير قيمة افتراضية عند عدم وجود user_id
        ]);

        if (isset($data['user_id'])) {
            $user = Client::find($data['user_id']);
            if ($user && $user->fcm_token != null) {
                // إرسال الإشعار إلى Firebase
                $this->sendFirebaseNotification($user->fcm_token, $data['name'], $data['message']);
            }   
        } else {
            // في حال عدم وجود user_id، يمكن إرسال الإشعار للجميع (إذا كان هذا منطقيًا في حالتك)
            // أو تنفيذ أي إجراء بديل
        }

        return $notification;
    }

//     public function createNotification($data)
// {
//     // إنشاء الإشعار وحفظه في قاعدة البيانات
//     $notification = Notification::create([
//         'name' => $data['name'],
//         'message' => $data['message'],
//         'user_id' => $data['user_id'] ?? null,
//     ]);

//     $user = Client::find($data['user_id']); 
//     if ($user && $user->fcm_token) {
//         // إرسال الإشعار إلى Firebase
//         sendFirebaseNotification($user->fcm_token, $data['name'], $data['message']);
//     }

//     return $notification;
// }



    

    public function updateNotification($notification , $data)
    {
        if (isset($data['meta_image'])) {
            $notification->updateFile($data['meta_image'], '_meta_image');
        }
        $notification->update($data);
    }

     public function deleteNotification($notification)
    {
        $notification->delete();
    }

    public function reorder($notification, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($notification, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $notification)
    {
        return ReorderHelper::saveReorder($all_entries, $notification);
    }

    public
    function sendFirebaseNotification($token, $name, $message, $payload = [])
    {
        dd([
            'token' => $token,
            'name' => $name,
            'message' => $message,
        ]);

        // Path to your Firebase JSON key file
        $keyFilePath = storage_path('firebase/project-file.json');

        // Create a new Google Client

        $client = new Client();
        $client->setAuthConfig($keyFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        // Get an OAuth 2.0 access token
        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        // Firebase API URL
        $url = "https://fcm.googleapis.com/v1/projects/gci-app-c3c63/messages:send";

        // Message payload

        $fields = array(
            'message' => [
                'token' => $token,
                'notification' => array(
                    'name' => $name,
                    "message" => $message
                ),

                'android' => array(
                    'priority' => 'high',
                ),
                'apns' => array(
                    'headers' => [
                        'apns-priority' => '10',
                    ]
                )
            ]
        );

        // Set up the HTTP headers
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

}
