<?php

namespace App\Repositories\Sns;

use App\Model\Setting\SnsList;
use App\Repositories\Repository;

class SnsRepository extends Repository
{
	public function __construct(SnsList $model)
    {
        parent::__construct($model);
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->description = $data['description'];
            $model->website = $data['website'];
            $model->color = $data['color'];
            $model->created_at =__utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id)->loadMissing(['translations']);
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
                $model->description = $data['description'];
                $model->website = $data['website'];
                $model->color = $data['color'];
                $model->updated_at =__utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id)->loadMissing(['translations']);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }
}