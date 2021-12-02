<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\BusinessList;
use App\Repositories\GlobalSearch\GlobalSearchRepository;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keyword = $request->keyword;
        $results = json_encode($request->results);
        $businessListId = $request->businessListId;

        $storeSearchHistory = (new GlobalSearchRepository())->storeSearchResult($keyword, $results, $businessListId);

        return response(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchBusiness(Request $request) {
        $search = $request->search && $request->search != '' ? $request->search :null;

        // Sample search result
        $businessList = (new GlobalSearchRepository())->searchBusinessList($search);

        return response()->json(['searchResults' => $businessList]);
    }
}
