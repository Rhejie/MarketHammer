<?php

namespace App\Model;

use App\Model\BaseModel;

class FormFieldAnswer extends BaseModel
{
    //
    protected $table = 'form_field_answers';
    protected $guarded = [];

    public function formSubmissionFields() {
        return $this->belongsTo(FormSubmissionField::class, 'form_submission_form_field_id', 'id');
    }
}
