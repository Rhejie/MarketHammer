<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessType extends Model
{
    use SoftDeletes;
    
    protected $table = 'businesstypes';
    protected $guarded = ['id'];

    // public function businessList() {
    //     return $this->hasMany(BusinessLists::class, 'industyTypeID');
    // }

}
