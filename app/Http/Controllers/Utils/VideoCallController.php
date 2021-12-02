<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;

use App\Helpers\VideoCallHelper;
use App\Model\User;

class VideoCallController extends Controller
{
    public function getToken(/* Request $request,  */$roomname = null) {
        $videoCallHelper = new VideoCallHelper;

        $result = $videoCallHelper->getToken($roomname);

        /* if($request->users && count($request->users)) {
            foreach($request->users as $user) {

            }
        } */

        return $result;
    }

    public function getRingCentralConfig() {
        $videoCallHelper = new VideoCallHelper;

        $result = $videoCallHelper->getRingcentralConfig();

        return ['credentials' => $result];
    }

    public function getParticipantName($id) 
    {
        $name = User::where('id', $id)->first();

        return response()->json($name, 200);
    }
}
