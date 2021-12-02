<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BusinessList\BusinessListRepository;

use Auth;
use App\Model\Bookmarks;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('mypage/my_page');
    }

    public function details($id)
    {
        $businessData = (new BusinessListRepository)->getBusiness($id);
        
        if(!$businessData){
            //return redirect()->route('/');
        }

        $data = [
            'businessData' => $businessData
        ];

        return view('store/store_details', $data);
    }

    public function bookmarked_stores()
    {
        return view('store/bookmarked_stores');
    }

}
