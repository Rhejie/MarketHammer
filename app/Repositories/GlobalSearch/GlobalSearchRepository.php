<?php

namespace App\Repositories\GlobalSearch;

use App\Model\BusinessLists;
use App\Model\UserSearchHistories;
use Illuminate\Support\Facades\Auth;

class GlobalSearchRepository {

    public function searchBusinessList($keyword) {
        // SEARCH
        $businessList = BusinessLists::with(['businessBanners', 'businessAddress', 'reviews'])
            ->where(function($query) use($keyword) {
            $query->orWhere('businessName', 'LIKE', "%$keyword%");
            $query->orWhere('description', 'LIKE', "%$keyword%");
            $query->orWhere('email', 'LIKE', "%$keyword%");
            $query->orWhere('phone', 'LIKE', "%$keyword%");
            $query->orWhere('webAddress', 'LIKE', "%$keyword%");
            $query->orWhere('businessLicense', 'LIKE', "%$keyword%");
            $query->orWhereHas('businessAddress', function($query2) use($keyword) {
                $query2->where(function($query3) use($keyword) {
                    $query3->orWhere('street', 'LIKE', "%$keyword%");
                    $query3->orWhere('city', 'LIKE', "%$keyword%");
                    $query3->orWhere('state', 'LIKE', "%$keyword%");
                    $query3->orWhere('zip', 'LIKE', "%$keyword%");
                    $query3->orWhereHas('country', function($query4) use($keyword) {
                        $query4->where('name', 'LIKE', "%$keyword%");
                    });
                });
            });
            $query->orWhereHas('industryType', function($query2) use($keyword) {
                $query2->where(function($query3) use ($keyword) {
                    $query3->orWhere('code', 'LIKE', "%$keyword%");
                    $query3->orWhere('name', 'LIKE', "%$keyword%");
                });
            });
            $query->orWhereHas('cluster.clusterCategory.category', function($query2) use($keyword) {
                $query2->where(function($query3) use ($keyword) {
                    $query3->orWhere('code', 'LIKE', "%$keyword%");
                    $query3->orWhere('name', 'LIKE', "%$keyword%");
                });
            });

            $query->orWhereHas('assignedCategory.category', function($query2) use($keyword) {
                $query2->where('name', 'LIKE', "%$keyword%");
            });
        });

        $businessList = $businessList->get();

        return $businessList;
    }

    public function storeSearchResult($keyword, $results, $businessListId) {
        $searchHistory = new UserSearchHistories();
        $searchHistory->businessListID = $businessListId;
        $searchHistory->userID = Auth::user()->id;
        $searchHistory->keyword = $keyword;
        $searchHistory->results = $results;
        $searchHistory->save();

        return $this;
    }
}