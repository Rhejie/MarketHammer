<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFollower extends Model
{
    use SoftDeletes;
    
    protected $table = 'user_follower';
    
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(\App\Model\User::class, 'follower_id');
    }

    public function following() {
        return $this->belongsTo(\App\Model\User::class, 'following_id');
    }

    public function business() {
        return $this->belongsTo(\App\Model\Business::class, 'business_id');
    }
}
