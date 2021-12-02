<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Twilio\DestroyTwilioChatLogRequest;
use App\Http\Requests\Twilio\StoreTwilioChatLogRequest;
use App\Http\Resources\DefaultCollection;
use App\TwilioLog;
use App\TwilioPayload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TwilioChatLogController extends Controller
{
    public function findAll(Request $request)
    {
        $limit = $request->has('limit') ? (int) $request['limit'] : 50;
        $skip = $request->has('skip') ? (int) $request['skip'] : 0;

        $twilioLogs = TwilioLog::query()
            ->where('user_id', auth()->id())
            ->limit($limit)
            ->skip($skip)
            ->get();

        return response()->json(new DefaultCollection($twilioLogs));
    }
    /**
     * @throws ValidationException
     */
    public function store(StoreTwilioChatLogRequest $request)
    {
        $logId = $request['channel_sid'];
        $logType = TwilioLog::CHAT_CHANNEL_TYPE;
        $type = $request['type'];

        if (!in_array($type, ['channel_created', 'chat_created'])) {
            throw ValidationException::withMessages([
                'type' => "Invalid type"
            ]);
        }

        if ($request->acceptsJson()) {

            switch ($type) {

                case 'channel_created':

                    $twilioLog = TwilioLog::query()
                        ->where('log_id',  $logId)
                        ->where('log_type', $logType)
                        ->first();
                    if (!$twilioLog) {
                        TwilioLog::query()->create([
                            'log_id' => $logId,
                            'log_type' => $logType,
                            'user_id' => auth()->id(),
                        ]);
                    }

                    return response()->json([
                        'status' => 'created',
                    ], 201);

                case 'chat_created':

                    $this->validate($request, [
                        'payload' => 'required',
                    ]);
                    $payload = json_encode($request['payload']);

                    $twilioLog = TwilioLog::query()
                        ->where('log_id', $logId)
                        ->where('log_type', $logType)
                        ->first();

                    if (!$twilioLog) {
                        $twilioLog = TwilioLog::query()->create([
                            'payload' => $payload,
                            'log_type' =>  $logType,
                            'user_id' => auth()->id()
                        ]);
                    }

                    TwilioPayload::query()->create([
                        'payload' => $payload,
                        'twilio_log_id' => $twilioLog->id,
                    ]);

                    return response()->json([
                        'status' => "created",
                    ],201);
            }
        }
    }

    public function destroy(DestroyTwilioChatLogRequest $request)
    {
        if ($request->acceptsJson()) {

            $result = DB::table('twilio_logs')->where('log_id', $request['channel_sid'])->delete();
            return response()->json([
                'channel_sid' => $request['channel_sid'],
                'status' => $result >= 1 ? 'deleted' : 'not_deleted'
            ]);
        }
    }
}
