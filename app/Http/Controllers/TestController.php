<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TestController extends Controller
{
    public function test()
    {
    	$cache = cache('translations');

    	// dd(\App\Repositories\Buyer\BuyerFormTemplateRepository::all());
    	//dd(DB::table('business_levels')->get());

    	return view('test/test-view');
    }

	public function apiTest()
	{
		return "API is up running test!!";
	}

	public function updateDateEstablished()
    {
        \App\Model\Business::query()
            ->whereDate('date_established', '1970-01-01')
            ->update([
                'date_established' => NULL,
            ]);

        return response()->json(['done']);
    }
}
