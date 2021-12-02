<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustryCategory extends Model
{

    use SoftDeletes;
    protected $table = 'industrycategories';
    protected $guarded = ['id'];

     /**
	 * MODEL RELATIONS
     */

    public function industryType() {
        return $this->belongsTo(IndustryType::class, 'industryTypeID', 'id');
    }

    public function category() {
        return $this->belongsTo(Categories::class, 'categoryID', 'id');
    }
}
