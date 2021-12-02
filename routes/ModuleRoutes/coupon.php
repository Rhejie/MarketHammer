<?php

Route::group(['prefix' => 'coupon', 'namespace' => 'Home'], function() {
    Route::post('/get-user-coupons', 'CouponController@getUserCoupons');
});