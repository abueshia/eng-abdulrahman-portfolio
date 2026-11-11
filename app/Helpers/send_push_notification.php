<?php

use Google\Client;

// function sendFirebaseNotification($token, $name, $message)
// {
//     dd([
//         'token' => $token,
//         'name' => $name,
//         'message' => $message,
//     ]);
// }

function sendFirebaseNotification($token, $name, $message, $payload = [])
{
    
    // dd([
    //     'token' => $token,
    //     'name' => $name,
    //     'message' => $message,
    // ]);

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
