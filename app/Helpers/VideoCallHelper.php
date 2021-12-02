<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

class VideoCallHelper {

    // Get available category levels
    public function getToken($roomName = null, $is_guest = false) {

        // Required for all Twilio access tokens
        $twilioAccountSid = env('TWILIO_ACCOUNT_SID');
        $twilioApiKey     = env('TWILIO_API_KEY');
        $twilioApiSecret  = env('TWILIO_API_SECRET');

        // Required for Chat grant
        
        $serviceSid = env('TWILIO_SERVICE_INSTANCE_SID');

        $userIdentity = $is_guest ? '[guest]' : '[user_id]:'.Auth::user()->id;

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600,
            $userIdentity//strtolower(Auth::user()->id)
        );

        // Create Grant
        if(!$roomName) {
            $roomName = 'Video_Call:'.strtotime("now");
        }

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);
        $token->addGrant($videoGrant);
        
        return [
            'success' => $token && $token->toJWT() ? true : false, 
            'token' => $token->toJWT(), 
            'room_name' => $roomName, 
            'identity' => $userIdentity
        ];
    }

    public function getRingcentralConfig() {
        return [
            "RINGCENTRAL_CLIENTID" => env('RINGCENTRAL_CLIENTID'),
            "RINGCENTRAL_CLIENTSECRET" => env('RINGCENTRAL_CLIENTSECRET'),
            "RINGCENTRAL_SERVER" => env('RINGCENTRAL_SERVER'),
            "RINGCENTRAL_USERNAME" => env('RINGCENTRAL_USERNAME'),
            "FROM" => env('RINGCENTRAL_USERNAME'),
            "RINGCENTRAL_PASSWORD" => env('RINGCENTRAL_PASSWORD'),
            "RINGCENTRAL_EXTENSION" => env('RINGCENTRAL_EXTENSION'),
            "RECIPIENT" => '',//
            "RING_APP_NAME" => env('RINGCENTRAL_APP_NAME'),
            "RING_APP_VERSION" => env('RINGCENTRAL_APP_VERSION'),
        ];
    }
}