<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserCoupons;
use App\Repositories\Coupon\CouponRepository;

class CouponController extends Controller
{
    public function getUserCoupons(Request $request)
    {
    	$userId = $request->userId  && $request->userId != null ? $request->userId : Auth::id();

    	$couponIds =  UserCoupons::where('userID', $userId)->pluck('couponID')->toArray();

    	if (count($couponIds) > 0) {
            $coupons = (new CouponRepository)->getUserCoupons($couponIds);
        } else {
            $coupons = [];
        }
         // dd($coupons);  
        return response()->json(['coupons' => $coupons]);
    }
}
