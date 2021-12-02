<?php

namespace App\Repositories\Cluster;

use App\Model\BusinessLists;
use App\Model\BusinessCategory;
use App\Model\ClusterCategory;
use App\Model\Clusters;
use App\Model\Countries;
use App\Model\Themes;
use App\Model\User;
use App\Model\Users;

class ClusterRepository {
    
    public function getClusters($params) {
        $clusters = Clusters::with(['theme', 'country']);

        if($params->search && $params->search !== '') {
            $clusters = $clusters->where(function($query) use($params) {
                $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
                $query->orWhereHas('theme', function($query2) use($params) {
                    $query2->where('color', 'LIKE', "%$params->search%");
                });
                $query->orWhereHas('clusterCategory.category', function($query2) use($params) {
                    $query2->where('name', 'LIKE', "%$params->search%");
                });
                $query->orWhereHas('country', function($query2) use($params) {
                    $query2->where(function($query3) use($params) {
                        $query3->orWhere('code', 'LIKE', "%$params->search%");
                        $query3->orWhere('name', 'LIKE', "%$params->search%");
                    });
                });
            });
        }

        $clusters = $clusters->paginate($params->count);

        return $clusters;
    }

    public function getThemesForDropdown($searchQuery) {
        if($searchQuery && $searchQuery != '') {
            $themes = Themes::where('color', 'LIKE', "%$searchQuery%")->paginate(10);
        }else{
            $themes = Themes::paginate(10);
        }
        
        return $themes;
    }

    public function getCategoriesForDropdownById($id) {
        $categoryIds = ClusterCategory::where('clusterID', $id)->pluck('categoryID')->toArray();
        $categories = Categories::whereIn('id', $categoryIds)->get();

        return $categories;
    }

    public function getCategoriesForDropdown($searchQuery, $id) {

        $searchQuery = $searchQuery == '' || $searchQuery == null ? '' : $searchQuery;
        $categoryIds = ClusterCategory::where('clusterID', $id)->pluck('categoryID')->toArray();
        // dd($categoryIds, $id);
        if($searchQuery && $searchQuery != '') {
            $categories = Categories::where('name', 'LIKE', "%$searchQuery%")->whereIn('id', $categoryIds)->get();
        }else{
            $categories = Categories::whereIn('id', $categoryIds)->get();
            // $categories = Categories::all();
        }        
        return $categories;
    }

    public function getAllCategoriesForDropdown($searchQuery) {

        // $searchQuery = $searchQuery == '' || $searchQuery == null ? '' : $searchQuery;
        // dd($categoryIds, $id);
        // if($searchQuery && $searchQuery != '') {
        //     $categories = Categories::where('name', 'LIKE', "%$searchQuery%")->get();
        // }else{
            $categories = Categories::with('children.children')->whereNull('parentCategoryID')->orderBy('name', 'ASC')->get();
        // }        
        return $categories;
    }

    public function getclusterChildrenCategoryIds($parentID, $clustedId) {
        $categoryIds = ClusterCategory::where('clusterID', $clustedId)->pluck('categoryID')->toArray();

        $categories = Categories::whereIn('id', $categoryIds)->where('parentCategoryID', $parentID)->get();
        // if($searchQuery && $searchQuery != '') {
        //     $categories = Categories::where('name', 'LIKE', "%$searchQuery%")->get();
        // }else{
        //     $categories = Categories::all();
        // }

        
        return $categories;
    }

    public function getclusterChildrenCategoryIdsByQuery($parentID, $clustedId, $searchQuery) {
        $categoryIds = ClusterCategory::where('clusterID', $clustedId)->pluck('categoryID')->toArray();
        $searchQuery = $searchQuery == '' || $searchQuery == null ? '' : $searchQuery;

        
        if($searchQuery && $searchQuery != '') {
            $categories = Categories::whereIn('id', $categoryIds)->where('parentCategoryID', $parentID)->where('name', 'LIKE', "%$searchQuery%")->get();
        }else{
            $categories = Categories::whereIn('id', $categoryIds)->where('parentCategoryID', $parentID)->get();
        }

        
        return $categories;
    }

    public function getAllClusterChildrenCategoryIdsByQuery($parentID, $searchQuery) {
        // $categoryIds = ClusterCategory::where('clusterID', $clustedId)->pluck('categoryID')->toArray();
        $searchQuery = $searchQuery == '' || $searchQuery == null ? '' : $searchQuery;

        
        if($searchQuery && $searchQuery != '') {
            $categories = Categories::where('parentCategoryID', $parentID)->where('name', 'LIKE', "%$searchQuery%")->get();
        }else{
            $categories = Categories::where('parentCategoryID', $parentID)->get();
        }

        
        return $categories;
    }

    public function getCountriesForDropdown($searchQuery) {
        if($searchQuery && $searchQuery != '') {
            $countries = Countries::where(function($query) use($searchQuery) {
                $query->orWhere('code', 'LIKE', "%$searchQuery%");
                $query->orWhere('name', 'LIKE', "%$searchQuery%");
            })->paginate(10);
        }else{
            $countries = Countries::paginate(10);
        }

        return $countries;
    }

    public function storeCluster($params) {
        // dd($params);
        $cluster = new Clusters();
        $cluster->code = $params->code;
        $cluster->name = $params->name;
        $cluster->themeID = $params->themeId ? $params->themeId : null;
        $cluster->country_id = $params->countryId ? $params->countryId : null;
        $cluster->save();

        if(sizeof($params->clusterCategoryIds) > 0) {
            $categories = $this->saveCategories($params->clusterCategoryIds, $cluster->id);
        }

        return $cluster;
    }

    public function showCluster($id) {
        $cluster = Clusters::with(['theme', 'country'])->find($id);

        return $cluster;
    }

    public function updateCluster($id, $params) {
        $cluster = Clusters::find($id);
        $cluster->code = $params->code;
        $cluster->name = $params->name;
        $cluster->themeID = $params->themeId ? $params->themeId : null;
        $cluster->country_id = $params->countryId ? $params->countryId : null;
        $cluster->save();

        if(sizeof($params->clusterCategoryIds) > 0) {
            // foreach($params->clusterCategoryIds as $category) {
            //     $clusterCategory = ClusterCategory::updateOrCreate(
            //         ['clusterID' => $cluster->id, 'categoryID' => $category]
            //     );
            // }

            //  // Delete cluster categories
            // $deletedClusters = ClusterCategory::where('clusterID', $cluster->id)
            // ->whereNotIn('categoryID', $params->clusterCategoryIds)->delete();
            $categories = $this->saveCategoriesFromUpdateCluster($params->clusterCategoryIds, $id);
        }else{
            // Delete all cluster category of cluster
            $deletedClusters = ClusterCategory::where('clusterID', $cluster->id)->delete();
        }

        return $cluster;
    }

    public function saveCategoriesFromUpdateCluster(Array $data, $clusterID){

        $success = true;
        $saved = [];

        // ids to be restored. deleted and currently selected by user
        $toBeRestoredIds = ClusterCategory::onlyTrashed()->where(['clusterID' => $clusterID])->whereIn('categoryID', $data)->pluck('categoryID')->toArray();

        //exclude toBeRestoredIds from data array
        $insertdata = array_diff($data, $toBeRestoredIds);

        // dd($data, $insertdata);

        foreach ($insertdata as  $cat) {
            $category = ClusterCategory::where(['clusterID' => $clusterID, 'categoryID' => $cat])->first();
            if($category == null){
                $category = new ClusterCategory;
                $category->clusterID = $clusterID;
                $category->categoryID = $cat;
                $category->save();
            }
        }

        //restore soft deleted categories that are selected by user
        $category = ClusterCategory::onlyTrashed()->where(['clusterID' => $clusterID])->whereIn('categoryID', $data)->restore();

        $removedIds = ClusterCategory::whereNotIn('categoryID', $data)->where('clusterID', $clusterID)->pluck('categoryID')->toArray(); // check ids associated from cluster that are not included (checked from checkbox)

        // delete all categories not included
        $deleteCat = ClusterCategory::whereIn('categoryID', $removedIds)->where('clusterID', $clusterID)->delete();

        return $success;
    }

    public function saveCategories(Array $data, $clusterID){

        $success = true;

        foreach ($data as  $cat) {
            $category = new ClusterCategory;
            $category->clusterID = $clusterID;
            $category->categoryID = $cat;
            $category->save();
        }

        return $success;
    }


    public function destroyCluster($id) {
        // 1. remove all categories under cluster
        $deletedClusterCategories = ClusterCategory::where('clusterID', $id)->delete();

        // 2. remove clusterID on all users under cluster
        $removeClusterOnUsers = Users::where('clusterID', $id)->update([
            'clusterID' => null
        ]);

        // 3. remove clusterID on businesslists
        $removeClusterOnBusinessList = BusinessLists::where('clusterID', $id)->update([
            'clusterID' => null
        ]);

        // 4. remove cluster
        $removeCluster = Clusters::find($id)->delete();

        return $this;
    }
}