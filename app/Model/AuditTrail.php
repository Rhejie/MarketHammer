<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    //
    protected $table = 'audit_trail';
    
    protected $guarded = ['id'];

    public function business() {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function userType() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
