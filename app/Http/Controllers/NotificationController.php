<?php

namespace App\Http\Controllers;

use App\Events\AddChannelEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {

    $this->middleware('auth');

}

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('chat');

    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {

        return Message::with('user')->get();

    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {

        $user = Auth::user();


        $message = $user->messages()->create([
            'message' => 'HAHAHAHA'
        ]);

        broadcast(new AddChannelEvent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
