<?php

namespace App\Repositories\QSA;

use App\Repositories\Repository;
use App\Model\QSAList;

class QsaListRepository extends Repository
{
    public function __construct(QSAList $model)
    {
        parent::__construct($model);
    }

    public function getList($request)
    {
        $getList = $this->model();

        $searchString = $request->input('search');
        $params = null;

        if ($searchString) {
            $getList = $getList->where(function($query) use($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });
        }

        if(isset($request->business_id) && $request->business_id !== null){
            $business_id = $request->business_id;
            $getList = $getList->with(['businessQsa' => function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            }]);

            $getList = $getList->whereHas('businessQsa', function($q) use($business_id){
                $q->where('business_id', '=', $business_id);
            });
        }
        //Do not fetc qsa existing to params : not_in_business_id (int)
        else if(isset($request->not_in_business_id) && $request->not_in_business_id !== null){
            $business_id = $request->not_in_business_id;
            $getList = $getList->whereDoesntHave('businessQsa', function($q) use($business_id){
                $q->where('business_id', '=', $business_id);
            });
        }

        $getList = $getList->with(['qsaType' => function ($query){
                        $query->with(['translations']);
                    }, 'translations']);
        $getList = $getList->orderBy('id', 'DESC')->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $getList;
    }

    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->qsa_type_id = $data['qsa_type_id'];
            $model->description = $data['description'];
            $model->created_at =__utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                // return $this->get($model->id)->with(['qsaType' => function ($query){
                //     $query->with(['translations']);
                // }, 'translations']);
                return $this->model()->with(['qsaType' => function ($query) {
                        $query->with('translations');
                    }])->find($model->id)->loadMissing(['translations']);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
    }

    /**
     * Override parent update functionality.
     *
     * @param $id <int>
     * @param $data <array>
     *
     * @return <object || boolean>
     */
    public function update(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->name = $data['name'];
                $model->qsa_type_id = $data['qsa_type_id'];
                $model->description = $data['description'];
                $model->updated_at =__utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    // return $this->get($model->id);
                    return $this->model()->with(['qsaType' => function ($query) {
                        $query->with('translations');
                    }])->find($model->id)->loadMissing(['translations']);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }
}
