<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

use App\Helpers\ChatHelper;

class BuyerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = 'buyer';
        $pageData = User::with(['usertype'])->find(Auth::user()->id);
        return view('backoffice/index', ['user_info' => $pageData, 'page' => $page]);
    }

     /**
     * Contact Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact() // previously fetch
    {

        $user_info = User::with(['usertype'])->find(Auth::user()->id);
        $pageData = [
            'userData' => $user_info,
            'pageType' => 'buyer'
        ];

        // return blade
        return view('buyer/contact', [
            'pageData' => $pageData
        ]);
    }

    public function message()
    {
        $chatHelper = new ChatHelper;
        $getToken = $chatHelper->getToken();
        $token = $getToken['token'] ?? null;

        $users = User::with(['usertype'])->get();

        /* return response()->json(['users' => $users, 'activeUser' => Auth::user()]); */

        $pageData = [
            'token' => $token,
            'users' => $users,
            'activeUser' => Auth::user()
        ];

        return view('buyer/message', [
            'pageData' => $pageData
        ]);
    }
}
