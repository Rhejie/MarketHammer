<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    protected $table = 'useraddresses';
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'userAddressID');
    }

    public function country() {
        return $this->belongsTo(Countries::class, 'countryID', 'id');
    }
    
}
