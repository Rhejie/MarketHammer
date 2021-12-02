<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Events;
use App\Model\EventMedias;

use App\Repositories\Event\EventRepository;

class EventController extends Controller
{
    public function getEvents(Request $request) 
    {
    	$events = (new EventRepository())->getEvents($request->timezone);
    	// dd($events);
        return response()->json(['events' => $events]);
    }

    public function getEventMedias(Request $request) 
    {
        $eventMedias = (new EventRepository())->getCurrentEvents($request->timezone);
        // dd($eventMedias);
        return response()->json(['eventMedias' => $eventMedias]);
    }
}
