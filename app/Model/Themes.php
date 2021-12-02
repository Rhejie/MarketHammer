<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Themes extends Model
{
    use SoftDeletes;
    
    protected $table = 'themes';

     /**
	 * MODEL RELATIONS
     */

    public function cluster() {
        return $this->hasMany(Clusters::class, 'themeID');
    }
}
