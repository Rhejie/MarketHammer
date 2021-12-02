<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessEsg extends Model
{
    protected $fillable = ['business_id', 'air_pollu_grade', 'water_pollu_grade', 'noise', 'dom_water_waste', 'ind_water_waste'];
}
