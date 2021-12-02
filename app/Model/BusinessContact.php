<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessContact extends Model
{
    use SoftDeletes;
    
    protected $table = 'business_contact';
    
    protected $guarded = ['id'];

    public function parentBusiness() {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
