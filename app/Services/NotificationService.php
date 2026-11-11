<?php

namespace App\Services;

use App\Models\Notification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $client;
    protected $tokenUri;
    protected $serviceAccount;

    public function __construct()
    {
        $this->client = new Client();
        $this->tokenUri = 'https://oauth2.googleapis.com/token';
        $this->serviceAccount = json_decode(File::get(storage_path('app/firebase/project-file.json')), true);
    }
    protected function getAccessToken()
    {
        $token = cache()->get('firebase_access_token');

        if ($token) {
            return $token;
        }

        $now = time();
        $jwt = $this->createJwt($now);
        $response = $this->client->post($this->tokenUri, [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
        ]);

        $body = json_decode((string)$response->getBody(), true);
        $token = $body['access_token'];
        $expiresIn = $body['expires_in'];
        cache()->put('firebase_access_token', $token, $expiresIn - 60);
        return $token;
    }

    protected function createJwt($now)
    {
        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT',
        ];

        $claims = [
            'iss' => $this->serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => $this->tokenUri,
            'iat' => $now,
            'exp' => $now + 3600,
        ];

        $headerEncoded = $this->base64UrlEncode(json_encode($header));
        $claimsEncoded = $this->base64UrlEncode(json_encode($claims));

        $signature = '';
        openssl_sign($headerEncoded . '.' . $claimsEncoded, $signature, $this->serviceAccount['private_key'], 'sha256WithRSAEncryption');

        return $headerEncoded . '.' . $claimsEncoded . '.' . $this->base64UrlEncode($signature);
    }

    protected function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function sendNotification($deviceToken, $title, $body, $customData = [])
    {
        $accessToken = $this->getAccessToken();

        $data = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => $customData, // Additional custom data here
            ],
        ];

        Log::info('Sending notification with data: ' . json_encode($data));

        try {
            $response = $this->client->post('https://fcm.googleapis.com/v1/projects/' . $this->serviceAccount['project_id'] . '/messages:send', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            Log::info($response->getBody()->getContents());
            return json_decode((string)$response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = json_decode((string)$e->getResponse()->getBody(), true);
                if (isset($response['error']['details'])) {
                    foreach ($response['error']['details'] as $detail) {
                        if (isset($detail['@type']) && $detail['@type'] === "type.googleapis.com/google.firebase.fcm.v1.FcmError" && $detail['errorCode'] === 'UNREGISTERED') {
                            Log::warning("The registration token is not registered. Device token: " . $deviceToken);
                            // Remove the token from your database
                            // $this->removeTokenFromDatabase($deviceToken);
                            return ['error' => 'UNREGISTERED', 'message' => 'The registration token is not registered.'];
                        }
                    }
                }
            }

            Log::error("Failed to send notification: " . $e->getMessage());
            return ['error' => 'UNKNOWN', 'message' => 'Failed to send notification.'];
        }
    }

    public function sendNotifications(array $deviceTokens, $title, $body, $customData = [])
    {
        $accessToken = $this->getAccessToken();

        foreach ($deviceTokens as $deviceToken) {
            $data = [
                'message' => [
                    'token' => $deviceToken,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                ],
            ];

            try {
                $response = $this->client->post('https://fcm.googleapis.com/v1/projects/' . $this->serviceAccount['project_id'] . '/messages:send', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $data,
                ]);

                Log::info($response->getBody()->getContents());
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $response = json_decode((string)$e->getResponse()->getBody(), true);
                    if (isset($response['error']['details'])) {
                        foreach ($response['error']['details'] as $detail) {
                            if (isset($detail['@type']) && $detail['@type'] === "type.googleapis.com/google.firebase.fcm.v1.FcmError" && $detail['errorCode'] === 'UNREGISTERED') {
                                Log::warning("The registration token is not registered. Device token: " . $deviceToken);
                                // Optionally remove the token from your database
                                // $this->removeTokenFromDatabase($deviceToken);
                            }
                        }
                    }
                }

                Log::error("Failed to send notification: " . $e->getMessage());
            }
        }
    }

    public function createNotifications($title, $body, $payload, $user_id) {
        foreach($user_id as $id){
        $insert_notification = Notification::create([
            'user_id' => $id,
            'name' => $title,
            'message' => $body,
            // 'payload' => json_encode($payload),
        ]);
    }
        
    }


    public function createNotification($title, $body, $payload, $user_id)
    {
        $user_id = Notification::create([
                'user_id' => $user_id,
                'name' => $title,
                'message' => $body,
                // 'payload' => json_encode($payload),
            ]);
      
    }

}
