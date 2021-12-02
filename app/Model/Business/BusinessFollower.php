<?php

namespace App\Model\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessFollower extends Model
{
    use SoftDeletes;
    
    protected $table = 'business_follower';
    
    protected $guarded = ['id'];

    public function business() {
        return $this->belongsTo(\App\Model\Business::class, 'business_id');
    }

    public function user() {
        return $this->belongsTo(\App\Model\User::class, 'user_id');
    }

    public function supplierstatus()
    {
        return $this->belongsTo(\App\Model\SupplierStatus::class, 'supplier_status_id');
    }
}
