<?php

namespace App\Repositories\Event;

use Carbon\Carbon;
use App\Model\Events;
use App\Model\EventMedias;

class EventRepository {

    public function getEvents($timezone) {
        
        // $events = Events::all();
        $now = Carbon::now($timezone)->toDateString();

        // $events = Events::where('startDate', '<=', $now)->where('endDate', '>=', $now)->get();
    	$events = Events::with('eventMedias')->orderBy('id', 'DESC')->get();

        return $events;
    }

    public function getCurrentEvents($timezone)
    {
    	$now = Carbon::now($timezone)->toDateString();
    	// dd($now);
    	$eventIds = Events::where('startDate', '<=', $now)->where('endDate', '>=', $now)->pluck('id')->toArray();

    	$eventMedias = EventMedias::whereIn('eventID', $eventIds)->get();

    	$eventArr = [];
    	foreach ($eventMedias as $event) {
    		$eventArr[] = [
    			'id'			=> $event->id,
    			'eventID'		=> $event->eventID,
    			'mediaPath'		=> $event->mediaPath,
    			'created_at'	=> $event->created_at,
    			'updated_at'	=> $event->updated_at,
    			'eventName'		=> $event->event->name, 
    			'link'			=> $event->event->link
    		];
    	}
    	// dd($events->pluck('name'));
    	return $eventArr;
    }
}