<?php

namespace App\Repositories\Business;

use App\Repositories\Repository;
use App\Model\Business\BusinessFollower;
use Illuminate\Support\Facades\Auth;
class BusinessFollowerRepository extends Repository
{
    public function __construct(BusinessFollower $model)
    {
        parent::__construct($model);
    }

    public function follow($params){

    	$getFollower = $this->model();

    	//Check if business id and following id exist
    	$getFollower = $getFollower->where(['business_id' => $params->business_id, 'user_id' => $params->user_id]);
    	$getFollower = $getFollower->first();

    	$model = null;
    	if($getFollower && isset($getFollower->id)){
            //in case status is view and the current data is already following. Just set the current status
            if($params->status == 'view' && $getFollower->status != "view" && $getFollower->deleted_at == null){
                $params->status = $getFollower->status;
                //return $getFollower;
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

        if(isset($request->user_id) && $request->user_id){
        	$list = $list->where(['user_id' => $request->user_id]);
        }

        if(isset($request->status) && $request->status){
            $status = is_array($request->status) ? $request->status : [$request->status];
        	$list = $list->whereIn('status', $status);
        }

        $list = $list->where('user_id', Auth::user()->id)
        ->where('is_favorite', 1)
        ->with(['supplierstatus', 'business'])
        ->orderBy('business_follower.created_at', 'DESC')
        ->paginate($request->current_size, ['*'], 'page', $request->current_page);
        
        return $list;
    }

}