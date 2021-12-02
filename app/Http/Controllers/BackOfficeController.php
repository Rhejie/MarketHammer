<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class BackOfficeController extends Controller
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
        return view('backoffice/index');
    }

    public function redirect()
    {
        if(Auth::user()->userType->code == 'system_admin')
        {
            return redirect(RouteServiceProvider::HOME);
        }
        else if(Auth::user()->userType->code == 'supplier')
        {
            return redirect(RouteServiceProvider::SUPPLIER);
        }
        else if(Auth::user()->userType->code == 'buyer')
        {
            return redirect(RouteServiceProvider::BUYER);
        }
    }
}
