<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessClaims extends Model
{
	use SoftDeletes;


    protected $table = 'businesslistclaims';

    protected $guarded = 'id';


    public function files()
    {
    	return $this->hasMany(BusinessClaimFiles::class, 'businessClaimID', 'id');
    }

    public function business() 
    {
    	return $this->belongsTo(BusinessLists::class, 'businessListID', 'id'); 
    }
}
