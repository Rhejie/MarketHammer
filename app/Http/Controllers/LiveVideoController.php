<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LiveVideos;

class LiveVideoController extends Controller
{
    public function getLiveVideos(Request $request)
    {
        $id = $request->id;

        $streams = LiveVideos::where('businessListID', $request->id)->whereNull('deleted_at')->get();

        return response()->json(['streams' => $streams]);
    }

    public function getAllLiveVideos(Request $request)
    {
    	$id = $request->id;

    	$streams = LiveVideos::orderBy('id', 'DESC')->whereNull('deleted_at')->get();

    	return response()->json(['streams' => $streams]);
    }

    public function store(Request $request)
    {
    	// dd($request->all());
    	if ($request->caption == null || $request->type == null) {
    		return response()->json(null, 400);
    	}

    	if ($request->id != null) {
    		$stream = LiveVideos::find($request->id);
    	} else {
    		$stream = new LiveVideos;
    	}
    	
    	$stream->businessListID = $request->businessListID;
    	$stream->caption = $request->caption;
    	$stream->type = $request->type;
    	$stream->url = $request->url;
    	$stream->mediaPath = '/storage/'.$request->mediaPath;
    	$stream->save();

    	return response()->json([ 'success' => true,  'data' => $stream]);
    }

    public function deleteStream(Request $request)
    {
        $delete = LiveVideos::findOrFail($request->id)->delete();

        return response()->json(['success' => true, 'id' => $request->id]);
    }
}
