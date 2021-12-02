<?php

namespace App\Repositories\Machine;

use App\Repositories\Repository;
use App\Model\MachineProcessType;

class MachineProcessTypeRepository extends Repository
{
    public function __construct(MachineProcessType $model)
    {
        parent::__construct($model);
    }

    /**
     * Will fetch list of business category, this function will also paginate
     * the return data if $params is present
     *
     * @param $params <null | object> - filter return data
     *
     * @return <array>
     */
    public function processTypeList($params)
    {
        if ($params->search) {
            $unieMeasures = MachineProcessType::where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $unieMeasures = MachineProcessType::with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $unieMeasures;
    }

    public function storeProcessType(array $data)
    {
        /*$productCategory = new MachineProcessType();

        $productCategory->name = $params->name;
        $productCategory->bar_code = $params->bar_code;
        $productCategory->description = $params->description;
        $productCategory->save();

        return $productCategory;*/

        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->bar_code = $data['bar_code'];
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

    public function showProcessType($id)
    {
        $industryType = MachineProcessType::find($id);

        return $industryType;
    }

    public function updateProcessType(array $data, $id)
    {
        /*$productCategory = MachineProcessType::find($id);
        $productCategory->name = $params->name;
        $productCategory->description = $params->description;
        $productCategory->save();

        return $productCategory;*/

        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->name = $data['name'];
                $model->bar_code = $data['bar_code'];
                $model->description = $data['description'];
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

    public function destroyProcessType($id)
    {

        // 2. remove industryTypeID on businesslists
        //$businessList = BusinessLists::where('industryTypeID', $id)->update(['industryTypeID' => null]);

        // 3. remove productCategory on table
        $productCategory = MachineProcessType::find($id)->delete();

        return $this;
    }
}
