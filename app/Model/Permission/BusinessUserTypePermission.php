<?php

namespace App\Model\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessUserTypePermission extends Model
{
    
    protected $table = 'business_user_type_permission';
    
    protected $guarded = ['id'];

    public function business() {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function userType() {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }
}
