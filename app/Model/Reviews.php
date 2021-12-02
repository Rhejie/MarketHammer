<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
	protected $appends = ['user', 'images', 'videos'];

    public function getUserAttribute() {   
        $user = null;

        if($this->userID) {
            $user = User::find($this->userID);  
        }
        return $user;
    }

    public function banners() {
        return $this->hasMany(ReviewMedias::class, 'reviewID', 'id');
    }

    public function getImagesAttribute() {   
        $banner = null;

        if($this->id) {
            $banner = ReviewMedias::where('reviewID', $this->id)->where('type', 'image')->get();  
        }
        return $banner;
    }

    public function getVideosAttribute() {   
        $banner = null;

        if($this->id) {
            $banner = ReviewMedias::where('reviewID', $this->id)->where('type', 'video')->get();  
        }
        return $banner;
    }

    public function getCreatedAtAttribute($date)
	{
	    return date('M d, Y', strtotime($date));
	}
}
