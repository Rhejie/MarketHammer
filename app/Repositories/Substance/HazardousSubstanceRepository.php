<?php

namespace App\Repositories\Substance;

use App\Model\HazardousSubstance;
use App\Repositories\Repository;

class HazardousSubstanceRepository extends Repository
{
    public function __construct(HazardousSubstance $model)
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
    public function getHazardousSubstances($params = null)
    {
        $data = [];

        if ($params) {
            if ($params->search) {
                $data = HazardousSubstance::where(function($query) use($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                })
                ->with('translations')
                ->orderBy('id', 'DESC')
                ->paginate($params->count);
            } else {
                $data = HazardousSubstance::with('translations')
                ->orderBy('id', 'DESC')
                ->paginate($params->count);
            }
        } else {
            $data = HazardousSubstance::orderBy('id', 'DESC')->get()->toArray();
        }

        return $data;
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

            $model->cas_num = $data['cas_num'];
            $model->name = $data['name'];
            $model->description = $data['description'];
            $model->created_at =__utc_time_now();

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
        $data = HazardousSubstance::find($id);

        return $data;
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
        // $model = $this->get($id);

        // if ($model) {
        //     \DB::beginTransaction();
        //     try {
        //         $model->cas_num = $data['cas_num'];
        //         $model->name = $data['name'];
        //         $model->description = $data['description'];
        //         $model->updated_at =__utc_time_now();

        //         if ($model->save()) {
        //             if ($this->hasTranslationData()) {
        //                 $this->updateFieldTranslations($model);
        //             }

        //             \DB::commit();

        //             return $this->get($model->id)->loadMissing(['translations']);
        //         }
        //     } catch (\Exception $e) {
        //         \DB::rollBack();
        //         throw $e;
        //     }
        // }

        // return false;
        $hazard = $this->model->find($id);
        if($hazard) {
            $hazard->update([
                'cas_num' => $data['cas_num'],
                'name' => $data['name'],
                'description' => $data['description']
            ]);

            if($hazard) {
                if ($this->hasTranslationData()) {
                    $this->updateFieldTranslations($hazard);
                }
            }

            return $this->model()->find($id)->loadMissing(['translations']);
        }

        return false;
    }
}
