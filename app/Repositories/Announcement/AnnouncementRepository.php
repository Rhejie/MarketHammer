<?php

namespace App\Repositories\Announcement;

use App\Helpers\ListHelper;
use App\Model\Announcements;
use App\Model\BusinessLists;

class AnnouncementRepository
{

    public function getUserAnnouncements($businessListsIds)
    {
        $announcements = [];

        $lists = BusinessLists::whereIn('id', $businessListsIds)->get();

        // dd($lists[0]->announcements);

        foreach ($lists as $list) {
            foreach ($list->announcements as $announcement) {
                $announcements[] = $announcement;
            }
        }

        // dd(json_encode($announcements));
        return $announcements;
    }

    public function getAnnouncement($id)
    {
        $announcement = Announcements::find($id);
        return $announcement;
    }
}
