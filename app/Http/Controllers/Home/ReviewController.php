<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Reviews;
use App\Model\ReviewMedias;

class ReviewController extends Controller
{
    public function saveReview(Request $request)
    {
    	// dd($request->all());
    	$review = new Reviews;
    	$review->reviewContent = $request->reviewContent;
    	$review->rating = $request->rating;
    	$review->businessListID = $request->businessListID;
    	$review->userID = $request->userID;

    	$review->save();

        if (count($request->imageFile) > 0) {
            foreach ($request->imageFile as $imageFile) {
                $media = new ReviewMedias;
                $media->businessListID = $request->businessListID;
                $media->reviewID = $review->id;
                $media->mediaPath = $imageFile['filePath'];
                $media->caption = null;
                $media->type = 'image';
                $media->save();
            }
        }

        if (count($request->videoFile) > 0) {
            foreach ($request->videoFile as $videoFile) {
                $media = new ReviewMedias;
                $media->businessListID = $request->businessListID;
                $media->reviewID = $review->id;
                $media->mediaPath = $videoFile['filePath'];
                $media->caption = null;
                $media->type = 'video';
                $media->save();
            }
        }

    	return response()->json(['review' => $review]);
    }
}
