<?php

namespace App\Repositories\Buyer;

use App\Model\Buyer\FormSubmissions;
use App\Model\FormField\FormField;
use App\Model\FormField\FormFieldGroup;
use App\Model\FormTemplate\TemplateFormField;
use App\Model\FormTemplate\TemplateFormGroup;
use App\Repositories\Repository;
use App\Model\{Business, FormFieldAnswer, FormSubmissionField, FormSubmissionGroup};
use App\Model\Buyer\FormSubmissionToSupplier;
use App\Repositories\Buyer\{FormSubmissionRepository, FormSubmissionFieldRepository, FormSubmissionGroupRepository};
use App\Repositories\FormField\FormFieldRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BuyerFormListRepository extends Repository
{
    private $answerArray;
    public function __construct(FormSubmissions $model)
    {
        parent::__construct($model);
    }

    public function addForm($params)
    {
        $form = $this->model()->create([
            'form_id' => $params->form_id,
            'form_title' => $params->form_title,
            'refrence_id' => $params->refrence_id,
            'expiration_date' => \Carbon::parse($params->expiration_date)->format('Y-m-d'),
            'form_type_id' => $params->form_type_id,
            'form_submission_status_id' => $params->form_submission_status_id,
            'instruction' => $params->instruction,
            'buyer_id' => isset($params->buyer_id) ? $params->buyer_id : auth()->user()->id,
            'created_by' => auth()->user()->id,
        ]);

        if ($form) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($form);
            }
        }


        $formData = $this->model()->with(['formStatus', 'formType', 'user', 'translations'])->withCount(['FormToSupplierCount', 'FormDeclinedSupplierCount' => function($q) {
            $q->where('status', 'rejected');
        }, 'FormRecievedSupplierCount' => function($q) {
            $q->where('status', 'accepted')->orWhere('status', 'submitted');
        }])->orderBy('id', 'DESC')->first();

        return $formData;
    }

    public function getFormList($params)
    {
        // $forms = $this->model()->with(['formStatus', 'formType'])->get();
        if ($params->search) {
            $forms = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('form_title', 'LIKE', "%$params->search%");
                $query->orWhere('form_id', 'LIKE', "%$params->search%");
                $query->orWhere('expiration_date', 'LIKE', "%$params->search%");
                $query->orWhereHas('formStatus', function ($query2) use ($params) {
                    $query2->where('name', 'LIKE', "%$params->search%");
                });
                $query->orWhereHas('formType', function ($query2) use ($params) {
                    $query2->where('name', 'LIKE', "%$params->search%");
                });
            });
        } else {
            $forms = $this->model();
        }

        if(isset($params->buyer_id)) {
            $forms = $forms->where('buyer_id', $params->buyer_id);
        }

        if($params->form_type_id != 'All') {
            $forms = $forms->where('form_type_id', $params->form_type_id);
        }

        if($params->form_submission_status_id != 'All') {
            $forms = $forms->where('form_submission_status_id', $params->form_submission_status_id);
        }

        return $forms->with(['formStatus', 'formType', 'user', 'requestNda', 'translations'])->withCount(['FormToSupplierCount', 'FormDeclinedSupplierCount' => function($q) {
                $q->where('status', 'rejected');
            }, 'FormRecievedSupplierCount' => function($q) {
                $q->where('status', 'accepted')->orWhere('status', 'submitted');
            }])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
    }

    public function updateFormData($id, $params)
    {
        $updForm = $this->model->find($id);

        $updForm->update([
            'form_title' => $params->form_title,
            'expiration_date' => \Carbon::parse($params->expiration_date)->format('Y-m-d'),
            'form_type_id' => $params->form_type_id,
            'form_submission_status_id' => $params->form_submission_status_id,
            'created_by' => auth()->user()->id,
        ]);

        if ($updForm) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($updForm);
            }
        }

        $form = $this->model()->with(['formStatus', 'formType', 'user', 'translations'])->find($id);

        return $form;
    }

    public function cloneTemplate($id, $params)
    {
        $checkiftemplateIsNotEmpty = TemplateFormGroup::where('buyer_form_template_id', $id)->first();

        if (empty($checkiftemplateIsNotEmpty)) {
            $templateUi = 'No template created';
            return $templateUi;
        }

        // $checkIfHastemplate = FormBuilderTemplateFormGroup::where('form_submission_id', $params->form_submission_id)->where('buyer_form_template_id', $id)->first();

        if (!empty($checkIfHastemplate)) {
            $templateUi = 'has template';

            return $templateUi;
        }

        $template_form_groups = TemplateFormGroup::where('buyer_form_template_id', $id)->get();
        foreach ($template_form_groups as $temGroup) {
            $fieldGroups = FormFieldGroup::find($temGroup->form_field_group_id);

            $formBuilderFormGroup = FormSubmissionGroup::where('created_by', auth()->user()->id)->orderBy('id', 'DESC')
                ->where('name', $fieldGroups->name)
                ->where('form_submission_id', $params->form_submission_id)
                ->first();

            if (empty($formBuilderFormGroup)) {
                $createCloneFormGroup = FormSubmissionGroup::create([
                    'name' => $fieldGroups->name,
                    'description' => $fieldGroups->description,
                    'form_submission_id' => $params->form_submission_id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ]);
                // $cloneFormGroup = FormSubmissionGroup::orderBy('id', 'DESC')->first();
            } else {
                $createCloneFormGroup = FormSubmissionGroup::orderBy('id', 'DESC')->where('form_submission_id', $params->form_submission_id)->first();
            }

            $template_form_fields = TemplateFormField::where('template_form_group_id', $temGroup->id)->where('buyer_form_template_id', $id)->get();

            foreach ($template_form_fields as $field) {
                $formField = FormField::where('form_field_group_id', $fieldGroups->id)->where('id', $field->form_field_id)->first();

                $formBuilderFormField = FormSubmissionField::where('field_label', $formField->field_label)
                    ->where('field_type', $formField->field_type)
                    ->where('form_submission_id', $params->form_submission_id)
                    ->where('created_by', auth()->user()->id)->first();

                if (empty($formBuilderFormField)) {
                    $createCloneFormField = $createCloneFormGroup->formFields()->create([
                        'field_label' => $formField->field_label,
                        'field_type' => $formField->field_type,
                        'form_submission_id' => $params->form_submission_id,
                        'field_description' => $formField->field_description,
                        'field_options' => json_encode($formField->field_options),
                        'is_link_to_table' => $formField->is_link_to_table,
                        'source_table' => $formField->source_table,
                        'table_name' => $formField->table_name,
                        'table_column' => $formField->table_column,
                        'is_required' => $field->is_required,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                    ]);
                    // $cloneFormdFieldID = FormSubmissionField::orderBy('id', 'DESC')->first();
                }
            }
        }

        $templateUi = 'template added';

        return $templateUi;


    }
    public function formIDGenerated() {

        //$form = $this->model()->orderby('id', 'DESC')->first();
        $form = DB::table('form_submissions')->orderby('id', 'DESC')->first();
        
        $carbon = Carbon::now()->format('Y');

        if(!empty($form)) {
            $formID = $form->form_id;
            $year = strtok($formID, '-');

            if($year < $carbon) {
                $yearData = $carbon;
                $form_id = 1;
            }
            else {
                $yearData = $carbon;
                foreach(explode('-', $formID) as $data) {
                    $form_id = (int)$data + 1;
                }
            }

        }
        else {
            $form_id = 1;
            $yearData = $carbon;
        }

        return $yearData.'-'.str_pad($form_id, 4, '0', STR_PAD_LEFT);
        
    }

    /**
     * Build the template's form.
     *
     * @param $templateFields <array> - the array of form group and fields to be saved inside the template
     *
     * @return <boolean>
     */
    public function buildTemplate($templateGroups, $submissionId, $loadedFromTemplate)
    {
        $formGroup = new FormSubmissionGroupRepository(new FormSubmissionGroup);
        $formField = new FormSubmissionFieldRepository(new FormSubmissionField);

        $userId = auth()->user()->id;
        $now = __utc_time_now()->format('Y-m-d H:i:s');

        \DB::beginTransaction();
        try {
	        if ($loadedFromTemplate) {
	        	((new FormSubmissionRepository(new FormSubmissions))->clearSubmissionForm($submissionId));
	        }

	        foreach ($templateGroups as $group) {
	            // delete a group
	            if (isset($group['id']) && $group['id'] && $group['is_deleted']) {
	                $formGroup->delete($group['id']);

	                continue;
	            }

	            $groupForm = [
	            	'name' => $group['name'],
	            	'description' => $group['description'],
	                'form_submission_id' => $group['form_submission_id'],
	                'is_added_to_template' => $group['is_added_to_template'],
	                'level' => $group['level'] ?? 0,
	                'position' => $group['position'] ?? 0
	            ];

	            $newSubmissionGroup = true;

	            if ($group['id']) {
	                $groupForm['updated_at'] = $now;

	                $newSubmissionGroup = $formGroup->update($groupForm, $group['id']);
	            }
	            else if (!$group['id']) {
	                $groupForm['created_by'] = $userId;
	                $groupForm['created_at'] = $now;

	                $newSubmissionGroup = $formGroup->create($groupForm);
	            }

	            if ($newSubmissionGroup) {
	                foreach ($group['form_fields'] as $field) {
	                    // delete form field
	                    if ($field['id'] && $field['is_deleted']) {
	                        $formField->delete($field['id']);

	                        continue;
	                    }

	                    $fieldData = [
	                        'form_submission_id' => $field['form_submission_id'],
	                        'form_submission_group_id' => $newSubmissionGroup['id'] ?? $field['form_submission_group_id'],
	                        'field_label' => $field['field_label'],
	                        'field_type' => $field['field_type'],
	                        'field_description' => $field['field_description'],
	                        'field_options' => $field['field_options'] ? $field['field_options'] : null,
                            'field_settings' => $field['field_settings'] ? $field['field_settings'] : null,
	                        'is_link_to_table' => $field['is_link_to_table'],
	                        'table_name' => $field['table_name'],
	                        'source_table' => $field['source_table'],
	                        'table_column' => $field['table_column'],
	                        'is_required' => $field['is_required'],
	                        'is_added_to_template' => $field['is_added_to_template'],
	                        'level' => $field['level'] ?? 0,
	                        'position' => $field['position'] ?? 0,
	                    ];

	                    if ($field['id']) {
	                        $fieldData['updated_by'] = $userId;
	                        $fieldData['updated_at'] = $now;

	                        $formField->update($fieldData, $field['id']);
	                    } else {
	                        $fieldData['created_by'] = $userId;
	                        $fieldData['created_at'] = $now;

	                        $formField->create($fieldData);
	                    }
	                }
	            }
	    	}

	    	\DB::commit();
	    } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return true;
    }

    public function getSupppliersData($params) {

        $suppliers  = Business::query()
            ->select(['id', 'legal_name', 'created_at', 'business_category_id'])
            ->whereDoesntHave('formSubmissionToSupplier', function ($q) use ($params) {
            $q->where('form_submission_id', $params->form_submission_id);
        });

        if($params->search) {
            $suppliers->where('legal_name', 'LIKE', "%$params->search%");
        }

        $suppliers->where(function ($query) {
            $query->whereHas('owner', function ($query2){
                $query2->where(['user_type_id' => 2]);
            })
            ->orDoesntHave('owner');
        });
        $limit = 100;
        // can update the limit
        if (request()->has('limit')) {
            $limit = (int) request()['limit'];
            $suppliers->limit($limit);
            if (request()->has('skip')) {
                $skip = (int) request()['skip'];
                $suppliers->skip($skip);
            }
        }
        return $suppliers->limit(100)->get();

    }

    public function sentoSupplierManually($params) {

        $form = FormSubmissionGroup::where('form_submission_id', $params->form_submission_data->id)->where('created_by', auth()->user()->id)->first();
        if(!empty($form)) {
            if(!empty($params->selectedSuppliers)) {
                foreach($params->selectedSuppliers as $supplier) {
                    FormSubmissionToSupplier::create([
                        'form_submission_id' => $params->form_submission_data->id,
                        'buyer_id' => auth()->user()->id,
                        'supplier_id' => $supplier
                    ]);
                }

                return 'send successfully';
            }
            return 'no supplier selected';
        }
        else {
            return 'no template';
        }

    }

    public function answerSubmissionForm($id, $params) {
        if($params->search) {
            $formSubmissiontoSupplier = FormSubmissionToSupplier::where(function ($q) use ($params) {
                $q->whereHas('supplierData', function ($q2) use ($params) {
                    $q2->where('legal_name', 'LIKE', "%$params->search%");
                });
            })
            ->where('form_submission_id', $id)
            ->where('status', 'submitted')
            ->where('buyer_id', auth()->user()->id)
            ->has('answerSubmission')
            ->with(['supplierData', 'fromGroup', 'answerSubmission' => function ($q) {
                $q->with(['formSubmissionFields' => function ($query) {
                    $query->with('formBuilderFieldGroup');
                }]);
            }]);
        }
        else if($params->selected_at === 'Rejected') {
            $formSubmissiontoSupplier = FormSubmissionToSupplier::with(['supplierData', 'fromGroup', 'answerSubmission' => function ($q) {
                $q->with(['formSubmissionFields' => function ($query) {
                    $query->with('formBuilderFieldGroup');
                }]);
            }])
                ->where('form_submission_id', $id)->where('selected_at', null)->where('status', 'submitted')->where('buyer_id', auth()->user()->id)
                ->has('answerSubmission');
        }
        else if($params->selected_at === 'Selected') {
            $formSubmissiontoSupplier = FormSubmissionToSupplier::with(['supplierData', 'fromGroup', 'answerSubmission' => function ($q) {
                $q->with(['formSubmissionFields' => function ($query) {
                    $query->with('formBuilderFieldGroup');
                }]);
            }])
                ->where('form_submission_id', $id)->whereNotNull('selected_at')->where('status', 'submitted')->where('buyer_id', auth()->user()->id)
                ->has('answerSubmission');
        }
        else {
            $formSubmissiontoSupplier = FormSubmissionToSupplier::with(['supplierData', 'fromGroup', 'answerSubmission' => function ($q) {
                $q->with(['formSubmissionFields' => function ($query) {
                    $query->with('formBuilderFieldGroup');
                }]);
            }])
                ->where('form_submission_id', $id)->where('status', 'submitted')->where('buyer_id', auth()->user()->id)
                ->has('answerSubmission');
        }


        $formSubmissiontoSupplier = $formSubmissiontoSupplier
        ->with(['requestNda'])->get();


        if(!empty($formSubmissiontoSupplier)) {
            $answerArray = $formSubmissiontoSupplier->map(function ($answer) {
                $ans = $answer->answerSubmission->map(function ($an) {
                    if($an->formSubmissionFields->source_table != null && $an->value != null) {

                        $fromTable = DB::table($an->formSubmissionFields->source_table)->where('id', $an->value)->get();

                         foreach($fromTable as $form) {
                            $an['value'] = $form->name;
                         }
                         return $an;

                    }
                });

                return $answer;
            });
            return $answerArray;
        }

        return 'No answer';

    }

    public function fetchValueFromSelectedTable($params) {

        $data = DB::table($params->source_table)->where('id', $params->id)->first();

        return $data->name;

    }

    public function getOptionsData($params) {

        if($params->source_table) {
            $data = DB::table($params->source_table)->get();
            return $data;
        }

    }

}
