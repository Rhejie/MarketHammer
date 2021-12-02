<?php

namespace App\Repositories\UserSearchHistory;

use DB;
use Carbon\Carbon;
use App\Model\UserSearchHistories;

class UserSearchHistoryRepository {

   
    public function storeHistory($params) {
        $searchHistory = new UserSearchHistories();
        $searchHistory->userID = $params->userID;
        $searchHistory->keyword = $params->keyword;
        $searchHistory->created_at =  Carbon::now();
        $searchHistory->updated_at =  Carbon::now();
        $searchHistory->save();


        return $searchHistory;
    }

    public function mostSearched() {
        $mostSearched = UserSearchHistories::select(DB::raw('COUNT(keyword) as count'), 'keyword')->groupBy('keyword')->orderBy('count', 'DESC')->limit(10)->pluck('keyword');

        $data=[];
        foreach ($mostSearched as $search) {
        	$data[] = [
        		'value'	=> $search
        	];
        }
        // dd($data);
        return $data;
    }

  
}