<?php

namespace App\Repositories\Buyer;

use App\Repositories\Repository;
use App\Model\FormSubmissionGroup;

class FormSubmissionGroupRepository extends Repository
{
	public function __construct(FormSubmissionGroup $model)
    {
        parent::__construct($model);
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
            $model = new $this->model;
            $model->name = $data['name'];
            $model->description = $data['description'];
            $model->form_submission_id = $data['form_submission_id'];
            $model->is_added_to_template = $data['is_added_to_template'];
            $model->created_by = auth()->user()->id;
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
                $model->description = $data['description'];
                $model->form_submission_id = $data['form_submission_id'];
	            $model->is_added_to_template = $data['is_added_to_template'];
                $model->updated_by = auth()->user()->id;
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