<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessBanners extends Model
{
    use SoftDeletes;
    
    protected $table = 'business_banners';
    protected $guarded = ['id'];
}
