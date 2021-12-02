<?php

namespace App\Repositories\SystemData;

use App\Repositories\Repository;
use App\Model\State;

class StateRepository extends Repository
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }

    public function updateState(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                if ($this->hasTranslationData()) {
                    $this->updateFieldTranslations($model);
                }

                \DB::commit();

                return $this->model->with(['translations'])->where(['id' => $model->id])->first();
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

    public function getList($params){

        $size = $params->input('size');
        $searchString = $params->input('searchString');

        $countries = State::select()->with(['translations']);

        if ($searchString) {
            $countries->where(function($q) use ($searchString) {
                $q->where('country_code', 'like', "%$searchString%");
                $q->orWhere('name', 'like', "%$searchString%");
                $q->orWhere('currency', 'like', "%$searchString%");
            });
        }

        if($params->country_id){
            $countries = $countries->where(['country_id' => $params->country_id]);
        }

        $countries = $countries->paginate($params->input('size'));

        return $countries;
    }
}