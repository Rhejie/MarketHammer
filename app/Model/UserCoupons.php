<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCoupons extends Model
{
	protected $table = 'usercoupons';

    public function coupon()
    {
    	return $this->hasOne(Coupons::class, 'id', 'couponID');
    }
}
