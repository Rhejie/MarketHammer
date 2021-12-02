<?php

namespace App\Repositories\Coupon;

use App\Helpers\ListHelper;
use App\Model\Coupons;

class CouponRepository {

    public function getUserCoupons($couponIds)
    {
        $coupons = Coupons::whereIn('id', $couponIds)->get();

        return $coupons;
    }

}