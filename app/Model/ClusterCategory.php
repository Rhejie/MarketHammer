<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClusterCategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'clustercategories';
    protected $guarded = ['id'];
    /**
	 * MODEL RELATIONS
     */

    public function cluster() {
        return $this->belongsTo(Clusters::class, 'clusterID', 'id');
    }

    public function category() {
        return $this->belongsTo(Categories::class, 'categoryID', 'id');
    }
}
