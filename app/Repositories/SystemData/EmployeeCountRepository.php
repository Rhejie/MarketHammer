<?php

namespace App\Repositories\SystemData;

use App\Model\EmployeeCount;
use App\Repositories\Repository;

class EmployeeCountRepository extends Repository
{
    public function __construct(EmployeeCount $model)
    {
        parent::__construct($model);
    }
    /**
     * Retrieve list of material types
     *
     * @param $params <object> - use to filter return data
     *
     * @return <array>
     */
    public function getEmployeeCounts($params = null)
    {
        $data = [];

        if ($params) {
            if ($params->search) {
                $data = EmployeeCount::where(function($query) use($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                })
                ->with('translations')->orderBy('id', 'DESC')->paginate($params->count);
            } else {
                $data = EmployeeCount::with('translations')->orderBy('id', 'DESC')->paginate($params->count);
            }
        } else {
            $data = EmployeeCount::get()->toArray();
        }

        return $data;
    }

    public function store(array $data) {
        /*$data = new EmployeeCount();

        $data->name = $params->name;
        $data->description = $params->description;
        $data->save();

        return $data;*/

        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->description = $data['description'];
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

    public function show($id) {
        $data = EmployeeCount::find($id);

        return $data;
    }

    public function update(array $data, $id)
    {
        /*$data = EmployeeCount::find($id);
        $data->name = $params->name;
        $data->description = $params->description;
        $data->save();

        return $data;*/

        // $model = $this->get($id);

        // if ($model) {
        //     \DB::beginTransaction();
        //     try {
        //         $model->name = $data['name'];
        //         $model->description = $data['description'];
        //         $model->updated_at = __utc_time_now();

        //         if ($model->save()) {
        //             if ($this->hasTranslationData()) {
        //                 $this->updateFieldTranslations($model);
        //             }

        //             \DB::commit();

        //             return $this->get($model->id);
        //         }
        //     } catch (\Exception $e) {
        //         \DB::rollBack();
        //         throw $e;
        //     }
        // }

        // return false;

        $employeeCount = $this->model->find($id);
        if($employeeCount) {
            $employeeCount->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);

            if($employeeCount) {
                if ($this->hasTranslationData()) {
                    $this->updateFieldTranslations($employeeCount);
                }
            }

            return $this->model()->find($id)->loadMissing(['translations']);
        }

        return false;
    }

    public function destroy($id) {
        $data = EmployeeCount::where('id', $id)->delete();

        return $this;
    }
}
