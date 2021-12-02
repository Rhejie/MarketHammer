<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Bookmarks;
use App\Repositories\Announcement\AnnouncementRepository;

class AnnouncementController extends Controller
{

    public function index()
    {
        //
    }

    public function getUserAnnouncements(Request $request)
    {
        $userId = $request->userId  && $request->userId != null ? $request->userId : Auth::id();

        $bookmarkedStoresId = Bookmarks::where('userID', $userId)->pluck('businessListID')->toArray();

        // dd(count($bookmarkedStoresId) > 0);

        if (count($bookmarkedStoresId) > 0) {
            $announcements = (new AnnouncementRepository)->getUserAnnouncements($bookmarkedStoresId);
        } else {
            $announcements = [];
        }
                
        return response()->json(['announcements' => $announcements]);
    }

    public function show(Request $request)
    {
        $id = $request->id;

        $announcement = (new AnnouncementRepository)->getAnnouncement($id);
                
        return response()->json(['announcement' => $announcement, 'store' => $announcement->businesslists]);
    }


}
