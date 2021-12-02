<?php

namespace App\Model;

use App\Model\Buyer\FormSubmissionToSupplier;
use Illuminate\Database\Eloquent\Model;

class FormSubmissionField extends BaseModel
{
    //
    protected $table = 'form_submission_fields';
    protected $fillable = [
    	'form_submission_group_id',
    	'is_link_to_table',
    	'is_required',
    	'is_added_to_template',
    	'table_name',
    	'table_column',
    	'form_submission_id',
        'source_table',
    	'field_label',
    	'field_type',
    	'field_description',
    	'field_options',
    	'created_by',
    	'updated_by'
    ];

    /**
     * Automatically cast columns defined here to the specified data type after retrieval
     *
     * @var <array>
     * */
    protected $casts = [
    	'field_options' => 'array',
        'field_settings' => 'array'
    ];

    /**
     * Decode field_options value
     *
     * @param $value - the column value from DB
     *
     * @return <array | null>
     */
    public function getFieldOptionsAttribute($value)
    {
        return $value ? json_decode($value) : null;
    }

    public function getFieldSettingsAttribute($value)
    {
        return $value ? json_decode($value) : null;
    }

    public function formBuilderFieldGroup()
    {

        return $this->belongsTo(FormSubmissionGroup::class, 'form_submission_group_id', 'id');
    }

    public function formSubmissionToSupplier() {

        return $this->belongsTo(FormSubmissionToSupplier::class, 'form_submission_id', 'form_submission_id');
    }

    public function answerSupplier() {
        return $this->belongsTo(FormFieldAnswer::class, 'id', 'form_submission_form_field_id');
    }
}
