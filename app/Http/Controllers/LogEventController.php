<?php

namespace App\Http\Controllers;

use App\Events\FireLogEvent;
use Illuminate\Http\Request;

class LogEventController extends Controller
{
    //
    public function __invoke(Request $request) {
        $this->validate($request, [
            'data_payload' => "required",
            'identities' => "required",
        ]);

        $receivers = [];

        foreach ($request['identities'] as $identity) {
            $uId = str_replace('[user_id]:', '', $identity);

            if (!in_array($uId, $receivers)) $receivers[] = $uId;

        }
        foreach ($receivers as $r) {
            broadcast(new FireLogEvent($r, $request['data_payload']));
        }
        return response()->json($request->all());


    }
}
