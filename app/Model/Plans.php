<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'plans';

    /**
	 * MODEL RELATIONS
     */

    public function businessList() {
        return $this->hasMany(BusinessLists::class, 'planID');
    }
}
