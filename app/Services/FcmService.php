<?php

namespace App\Services;

use Google\Client;
use Google\Service\FirebaseCloudMessaging;
use Illuminate\Support\Facades\Http;

class FcmService {
    private $baseUrl='https://www.googleapis.com/auth/firebase.messaging';
    private $projectId;
    private $accessToken;
    
    public $title;
    public $body;
    public $token;
    public $url = '';
    public $id = '';
    public $topic;

    public function __construct(){
        $firebaseCredentialsPath = storage_path('app/private/chat-app-cb803-firebase-adminsdk-fbsvc-23caf005f8.json');

        if (!file_exists($firebaseCredentialsPath)) {
            return response()->json(['error' => 'Firebase credentials file not found'], 500);
        }
      
         $client = new Client();
         $client->setAuthConfig($firebaseCredentialsPath);
         $client->addScope($this->baseUrl);
 
        
         if ($client->isAccessTokenExpired()) {
             $client->fetchAccessTokenWithAssertion();
         }
         $this->accessToken = $client->getAccessToken()['access_token'];
 
         
         $this->projectId = json_decode(file_get_contents($firebaseCredentialsPath), true)['project_id'];
    }

    public function sendToToken(){
       
         $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";
 
       
         $payload = [
             'message' => [
                 'token' => $this->tokens, 
                 'notification' => [
                     'title' => $this->title,
                     'body' => $this->body,
                 ],
                 'data' => [
                     'url' => $this->url,
                     'id' => $this->id,
                 ],
             ]
         ];
 
         // Send request to FCM
         $response =Http::withHeaders([
             'Authorization' => "Bearer {$this->accessToken}",
             'Content-Type' => 'application/json',
         ])->post($url, $payload);

    }

    public function sendToTopic(){
        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $data = [
            'message' => [
                'topic' => $this->topic, // Send to a topic instead of users
                'notification' => [
                    'title' => $this->title,
                    'body' => $this->body,
                ],
                'data' => [
                    'url' =>$this->url,
                    'id' => $this->id,
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        return response()->json([
            'message' => 'Notification sent to topic: ' . $this->topic,
            'response' => $response->json(),
        ]);
    }
}