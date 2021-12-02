<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;

use App\Helpers\ChatHelper;

class ChatController extends Controller
{
    //
    public function getToken() {
        $chatHelper = new ChatHelper;

        return $chatHelper->getToken();

        // render token to json
        return response()->json([
            "status" => "success",
            "token" => $token->toJWT()
        ]);
    }
}
