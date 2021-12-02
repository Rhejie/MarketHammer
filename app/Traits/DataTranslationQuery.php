<?php

namespace App\Traits;

use App\Model\FieldValueTranslator;

trait DataTranslationQuery
{
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

	/**
	 * Scope query to retrieve the translation values of the dynamically trasnlated fields in a certain tables
	 */
	public function scopeLocaleTranslation($query)
	{
	    $locale = config('app.locale');
	    if ($locale === 'jp') {
	        $locale = 'jap';
        }
		return $query->with(['translations' => function ($q) use ($locale){
			$locale = 'lang_' . $locale;

			$q->select(['id', 'table_id', 'table', 'field', 'value', $locale]);
		}]);
	}
}