<?php

namespace App\Model;

class ComplexLocation extends \App\Model\BaseModel
{
    protected $fillable = ['name', 'description', 'country_id'];
    protected $appends = ['country'];

    public function businessList()
    {

        return $this->hasMany(Business::class);
    }

    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'complex_locations');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getCountryAttribute()
    {
        $country = '';
        if ($this->country_id) {
        	$cnt = Country::where(['id' => $this->country_id])->first();
        	$country = $cnt ? $cnt->name : "";
        }
        return $country;
    }
}
