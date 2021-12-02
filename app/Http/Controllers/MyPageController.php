<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $loggedinuser = User::with('userAddress.country')->with('userType')->where('id', $user->id)->first();
        return view('mypage/my_page', compact('loggedinuser'));
    }

    public function store_details()
    {
        return view('mypage/store_details');
    }

    public function search_history()
    {
        return view('mypage/search_history');
    }

    public function my_coupon()
    {
        return view('mypage/my_coupon');
    }

    public function event()
    {
        return view('mypage/event');
    }
    public function show_event()
    {
        return view('home/show_event');
    }
    public function announcements()
    {
        return view('mypage/announcements/index');
    }

    public function show_announcement($id)
    {
        // pass id for now
        return view('mypage/announcements/show', compact('id'));
    }

    public function help()
    {
        return view('mypage/help');
    }

    public function qna()
    {
        return view('mypage/qna');
    }

    public function chat_support()
    {
        return view('mypage/chat_support');
    }

}
