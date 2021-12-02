<?php

namespace App\Model\Business;

use App\Model\Business;
use App\Model\Material;
use Illuminate\Database\Eloquent\Model;

class BusinessMaterial extends Model
{
    //
    protected $fillable = ['business_id', 'material_id'];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id')->with('materialType');
    }

    public function businessList()
    {
        return $this->belongsTo(Business::class);
    }
}
