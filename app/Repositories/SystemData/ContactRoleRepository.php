<?php

namespace App\Repositories\SystemData;

use App\Repositories\Repository;
use App\Model\Setting\ContactRole;

class ContactRoleRepository extends Repository
{
    public function __construct(ContactRole $model)
    {
        parent::__construct($model);
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

        $list = $list->with(['translations']);
        $list = $list->orderBy('id', 'DESC')->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $list;
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
            $model->created_at = __utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id);
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
                $model->updated_at = __utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

}
