<?php

namespace App\Observers;

use App\Model\BusinessLists;
use App\Model\UserSearchHistories;

class UserSearchHistoryObserver
{
    /**
     * Handle the user search histories "created" event.
     *
     * @param  \App\UserSearchHistories  $userSearchHistories
     * @return void
     */
    public function created(UserSearchHistories $userSearchHistories)
    {
        $searchCount = UserSearchHistories::where('businessListID', $userSearchHistories->businessListID)->count();

        // Update business list's search entry
        $businessListUpdate = BusinessLists::find($userSearchHistories->businessListID);
        $businessListUpdate->numberOfSearch = $searchCount;
        $businessListUpdate->save();
    }

    /**
     * Handle the user search histories "updated" event.
     *
     * @param  \App\UserSearchHistories  $userSearchHistories
     * @return void
     */
    public function updated(UserSearchHistories $userSearchHistories)
    {
        //
    }

    /**
     * Handle the user search histories "deleted" event.
     *
     * @param  \App\UserSearchHistories  $userSearchHistories
     * @return void
     */
    public function deleted(UserSearchHistories $userSearchHistories)
    {
        //
    }

    /**
     * Handle the user search histories "restored" event.
     *
     * @param  \App\UserSearchHistories  $userSearchHistories
     * @return void
     */
    public function restored(UserSearchHistories $userSearchHistories)
    {
        //
    }

    /**
     * Handle the user search histories "force deleted" event.
     *
     * @param  \App\UserSearchHistories  $userSearchHistories
     * @return void
     */
    public function forceDeleted(UserSearchHistories $userSearchHistories)
    {
        //
    }
}
