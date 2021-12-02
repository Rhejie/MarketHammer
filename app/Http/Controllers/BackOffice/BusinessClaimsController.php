<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BusinessClaims;

class BusinessClaimsController extends Controller
{
    public function index(Request $request)
    {
    	
        $businessClaims = BusinessClaims::with(['business', 'files'])->where('deleted_at', null)->get();

        return view('backoffice.businessclaims.index', [
            'businessClaims' => $businessClaims
        ]);
    }
}
