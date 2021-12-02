<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\UserSearchHistory\UserSearchHistoryRepository;

class SearchController extends Controller
{
    public function saveHistory(Request $request)
    {
    	$newCategory = (new UserSearchHistoryRepository())->storeHistory(json_decode(json_encode($request->all())));

        return response(null, 204);
    }

    public function mostSearched(Request $request)
    {
    	$mostSearched = (new UserSearchHistoryRepository())->mostSearched();

        return response(['mostSearched' => $mostSearched]);
    }
}
