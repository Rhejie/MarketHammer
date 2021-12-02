<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FirebaseDeviceToken extends Model
{
    //

    protected $fillable = ['user_id', 'device_token'];
}
