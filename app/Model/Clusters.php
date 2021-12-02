<?php

namespace App\Model;

use App\Model\BusinessLists;
use App\Model\ClusterCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clusters extends Model
{
    use SoftDeletes;

    protected $table = 'clusters';
    protected $guarded = ['id'];
    protected $appends = ['cluster_category_names', 'cluster_category_ids'];

    /**
	 * MODEL RELATIONS
     */

    public function businessList() {
        return $this->hasMany(BusinessLists::class, 'clusterID');
    }

    public function theme() {
        return $this->belongsTo(Themes::class, 'themeID', 'id');
    }
    
    public function clusterCategory() {
        return $this->hasMany(ClusterCategory::class, 'clusterID');
    }

    public function country() {
        return $this->belongsTo(Countries::class, 'country_id', 'id');
    }

    /**
	 * ACCESSORS
     */

    public function getClusterCategoryNamesAttribute() {
        $categoryNames = [];

        $categoryNames = ClusterCategory::with('category')->where('clusterID', $this->id)->whereHas('category')->get();
        $categoryNames = $categoryNames->pluck('category.name');
        
        return $categoryNames;
    }

    public function getClusterCategoryIdsAttribute() {
        $categoryIds = [];

        $categoryIds = ClusterCategory::with('category')->where('clusterID', $this->id)->whereHas('category')->get();
        $categoryIds = $categoryIds->pluck('category.id');

        return $categoryIds;
    }
}
