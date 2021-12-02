<?php

namespace App\Repositories\Buyer;

use App\Repositories\Repository;
use App\Model\FormTemplate\{BuyerFormTemplate, FormTemplateStatus};
use App\Model\FormTemplate\{TemplateFormField, TemplateFormGroup};
use App\Repositories\Buyer\{TemplateFormFieldRepository, TemplateFormGroupRepository};

class BuyerFormTemplateRepository extends Repository
{
	public function __construct(BuyerFormTemplate $model)
    {
        parent::__construct($model);
        $this->templateFormFieldRepository = new TemplateFormFieldRepository(new TemplateFormField);
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
            $model->form_template_status_id = $data['form_template_status_id'];
            $model->name = $data['name'];
            $model->content = $data['content'] ?? '';
            $model->buyer_id = $data['buyer_id'] ?? Auth::user()->id;
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

    public function show($id)
    {
        $templateGroup = $this->model->where(['id' => $id])
        ->with(['templateFormGroups' => function ($q) {
            $q->with(['formFieldGroup.translations']);
        }, 'translations'])->first();
        if($templateGroup){
            if(count($templateGroup->templateFormGroups) > 0){
                foreach ($templateGroup->templateFormGroups as $key => $template_form_groups) {
                    $params = ['template_form_group_id' => $template_form_groups->id, 'buyer_form_template_id' => $templateGroup->buyer_form_template_id];
                    $params = (object)$params;
                    $formFields = $this->templateFormFieldRepository->getFormFields($params);
                    $templateGroup->templateFormGroups[$key]['form_fields'] = $formFields;
                }
            }
            
        }

        return $templateGroup;

        
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
                $model->form_template_status_id = $data['form_template_status_id'];
                $model->name = $data['name'];
                $model->content = $data['content'] ?? '';
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
     * Build the template's form.
     * 
     * @param $templateFields <array> - the array of form group and fields to be saved inside the template
     * 
     * @return <boolean> 
     */
    public function buildTemplate($templateFields)
    {
        $formField = new TemplateFormFieldRepository(new TemplateFormField);
        $formGroup = new TemplateFormGroupRepository(new TemplateFormGroup);

        $userId = auth()->user()->id;
        $now = __utc_time_now()->format('Y-m-d H:i:s');

        foreach ($templateFields as $field) {
            if (!$field['form_field_group_id']) {
                continue;
            }

            // delete a group
            if (isset($field['id']) && $field['id'] && $field['is_deleted']) {
                $formGroup->delete($field['id']);

                continue;
            }

            $group = [
                'form_field_group_id' => $field['form_field_group_id'],
                'buyer_form_template_id' => $field['buyer_form_template_id'],
                'level' => $field['level'],
                'position' => $field['position']
            ];

            $tFormGroup = true;

            if ($field['id']) {
                $group['updated_by'] = $userId;
                $group['updated_at'] = $now;

                $tFormGroup = $formGroup->update($group, $field['id']);
            }
            else if (!$field['id']) {
                $group['created_by'] = $userId;
                $group['created_at'] = $now;

                $tFormGroup = $formGroup->create($group);
            }

            if ($tFormGroup) {
                foreach ($field['form_fields'] as $fField) {
                    // delete form field
                    if ($fField['is_deleted']) { //remove $fField['id']
                        $formField->delete($fField['id']);

                        continue;
                    }

                    $fieldData = [
                        'form_field_id' => $fField['form_field_id'],
                        'buyer_form_template_id' => $field['buyer_form_template_id'],
                        'level' => $fField['level'],
                        'position' => $fField['position'],
                        'is_required' => $fField['is_required'],
                    ];

                    if ($fField['id']) {
                        $fieldData['updated_by'] = $userId;
                        $fieldData['updated_at'] = $now;
                        $fieldData['template_form_group_id'] = $tFormGroup->id;

                        $formField->update($fieldData, $fField['id']);
                    } else {
                        $fieldData['created_by'] = $userId;
                        $fieldData['created_at'] = $now;
                        $fieldData['template_form_group_id'] = $tFormGroup->id;

                        $formField->create($fieldData);
                    }
                }
            }
        }

        return true; 
    }
}