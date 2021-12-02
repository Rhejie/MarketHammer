<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;

class ChatHelper {

    // Get available category levels
    public function getToken() {

        // Required for all Twilio access tokens
        $twilioAccountSid = env('TWILIO_ACCOUNT_SID');
        $twilioApiKey     = env('TWILIO_API_KEY');
        $twilioApiSecret  = env('TWILIO_API_SECRET');

        // Required for Chat grant
        
        $serviceSid = env('TWILIO_SERVICE_INSTANCE_SID');

        $userIdentity = '[user_id]:'.Auth::user()->id;

        // Create access token, which we will serialize and send to the client
        try {
            $token = new AccessToken(
                $twilioAccountSid,
                $twilioApiKey,
                $twilioApiSecret,
                3600,
                $userIdentity//strtolower(Auth::user()->id)
            );

            // Create Chat grant
            $chatGrant = new ChatGrant();
            $chatGrant->setServiceSid( $serviceSid);

            // Add grant to token
            $token->setIdentity( $userIdentity );
            $token->addGrant( $chatGrant );
            
            return ['success' => true, 'token' => $token->toJWT()];
        } catch (\Exception $e) {
            return ['success' => false];
        }

        // render token to json
        return response()->json([
            "status" => "success",
            "token" => $token->toJWT()
        ]);
    }
}