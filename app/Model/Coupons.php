<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
	protected $appends = ['expiry'];

    public function userCoupon()
    {
    	return $this->belongsTo(UserCoupons::class, 'couponID', 'id');
    }

    public function getExpiryAttribute() {   
        $expiry = '';

        if($this->validUntil) {
            $expiry = date('Y/m/d', strtotime($this->validUntil));  
        }
        return $expiry;
    }
}
