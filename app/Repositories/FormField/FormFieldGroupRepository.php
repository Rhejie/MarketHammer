<?php

namespace App\Repositories\FormField;

use App\Repositories\Repository;
use App\Model\FormField\FormFieldGroup;
use App\Model\FormField\FormField;
use App\Repositories\FormField\FormFieldRepository;

class FormFieldGroupRepository extends Repository
{
	public function __construct(FormFieldGroup $model)
    {
        parent::__construct($model);
        $this->formFieldRepository = new FormFieldRepository(new FormField);
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
            $model->description = $data['description'];
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

    /**
     * Retrieve all form field group with its corresponding form fields
     *
     * @return <array> 
     * */
    public function getFormFieldGroups($loadFieldWith = true)
    {
        if($loadFieldWith){
            return $this->model->all()->loadMissing(['formFields'])->toArray();
        }
        else{
            $formGroup = $this->model()->with(['translations'])->get()->toArray();
            foreach ($formGroup as $key => $group) {
                $params = ['form_field_group_id' => $group['id']];
                $params = (object)$params;
                $fields = $this->formFieldRepository->getFormFields($params);
                $formGroup[$key]['form_fields'] = $fields;
            }
            return $formGroup;
        } 
    }
}