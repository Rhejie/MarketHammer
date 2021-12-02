<?php

namespace App\Repositories\User;

use App\Model\AuditTrail;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class AuditTrailRepository extends Repository
{

	/**
     * Instancetiate the class.
     *
     * @param $model <AuditTrail> - the model class that this repository will be handling
     */
    public function __construct(AuditTrail $model)
    {
        parent::__construct($model);
    }

    public function getRecentSearch($params){

        $keyword = $this->model();

        if(isset($params->user_id)){
            $keyword = $keyword->where(['user_id' => $params->user_id]);
        }
        
        $keyword = $keyword->where(['action_type' => 'SEARCH'])->orderBy('created_at', 'DESC');
        $limit = isset($params->limit) ? $params->limit : 1;
        $keyword = $keyword->limit($params->limit)->get();
        return $keyword;
    }

    public function getCommonSearch($params){

        $keyword = $this->model()->select(['details', DB::raw('COUNT(details)')]);

        if(isset($params->user_id)){
            $keyword = $keyword->where(['user_id' => $params->user_id]);
        }
        
        $keyword = $keyword->where(['action_type' => 'SEARCH'])
            ->groupBy('details')
            ->orderBy(DB::raw('COUNT(details)'), 'DESC');
        $limit = isset($params->limit) ? $params->limit : 1;
        $keyword = $keyword->limit($limit)->get();
        return $keyword;
    }
}