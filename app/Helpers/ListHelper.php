<?php

namespace App\Helpers;

use App\Model\BusinessCategory;

class ListHelper {

    // Get available category levels
    public function categoryLevels() {
        $levels = [];

        if(Categories::count() > 0) {
            // get lowest level
            $lowest = Categories::orderBy('level', 'desc')->first(['level']);

            for ($i=0; $i <= $lowest->level; $i++) { 
                array_push($levels, $i+1);
            }

        }else{
            array_push($levels, 1);
        }

        return $levels;
    }

    public function parentCategoryPerLevel($level) {
        $parentCategories = [];
        if($level !== 1) {
            $parentCategories = Categories::where('level', ($level-1))->get();
        }

        return $parentCategories;
    }
}