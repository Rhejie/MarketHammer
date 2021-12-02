<?php

namespace App\Repositories\User;

use App\Repositories\Repository;
use App\Model\User\UserFollower;

class UserFollowerRepository extends Repository
{
    public function __construct(UserFollower $model)
    {
        parent::__construct($model);
    }

    public function follow($params){

    	$getFollower = $this->model();

    	//Check if follower and following id exist
    	$getFollower = $getFollower->where(['following_id' => $params->following_id, 'follower_id' => $params->follower_id]);
    	//Check if business id
    	if(isset($params->business_id)){
    		$getFollower = $getFollower->where(['business_id' => $params->business_id]);
    	}
    	$getFollower = $getFollower->withTrashed()->first();

    	$model = null;
    	if($getFollower && isset($getFollower->id)){
            //in case status is view and the current data is already following. Do not go through
            if($params->status == 'view' && $getFollower->status != "view" && $getFollower->deleted_at == null){
                return $getFollower;
            }
            
            if($getFollower->deleted_at != null){
                $getFollower->restore();
            }
    		
    		$data = $params->all();
    		$data['followed_at'] = $params->status == 'accepted' ? __utc_time_now() : null;
    		$data['deleted_at'] = null;

    		$model = $this->update($data, $getFollower->id);
    	}
    	else{

    		$model = $this->create($params->all());
    	}

    	return $model;
    }

    public function getList($request){

        $list = $this->model();

        $searchString = $request->input('search');
        $params = null;
        if($searchString){
            $params = function($query) use($searchString) {
                    $query->orWhere('name', 'LIKE', "%$searchString%");
            };
        }
        
        if($params){
            $list = $list->where($params);
        }

        if(isset($request->joinWith) && $request->joinWith){
            $list = $list->with($request->joinWith);
        }

        if(isset($request->business_id) && $request->business_id){
            $list = $list->where(['business_id' => $request->business_id]);
        }

        if(isset($request->follower_id) && $request->follower_id){
            $list = $list->where(['follower_id' => $request->follower_id]);
        }

        if(isset($request->following_id) && $request->following_id){
            $list = $list->where(['following_id' => $request->following_id]);
        }

        if(isset($request->status) && $request->status){
            $list = $list->where(['status' => $request->status]);
        }

        $list = $list->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $list;
    }

}