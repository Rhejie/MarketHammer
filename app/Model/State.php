<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTranslationQuery;

class State extends Model
{
    use DataTranslationQuery;
    protected $table = 'state';

    /**
	 * Retrieve all list of translations for the given table
	 *
	 * @return ActiveQuery
	 */
	public function translations()
    {
    	// dd($this->table);
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', $this->table);
    }
    
}
