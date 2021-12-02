<?php

namespace App\Model;

use App\Model\BaseModel;

class Country extends BaseModel
{
    protected $table = 'country';
    
    public function businessAddress() {
        return $this->hasMany(BusinessAddresses::class, 'countryID');
    }

    public function states() {
        return $this->hasMany(State::class, 'country_id');
    }
}
