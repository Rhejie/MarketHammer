<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HazardousSubstance extends Model
{
    use SoftDeletes;
    
    protected $table = 'hazardous_substance';
    protected $guarded = ['id'];

    /**
	 * MODEL RELATIONS
     */

    /**
     * Retrieve all list of translations for the hazardous substance column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'hazardous_substance');
    }
}
