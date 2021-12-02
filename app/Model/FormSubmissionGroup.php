<?php

namespace App\Model;

use App\Model\Buyer\FormSubmissionToSupplier;
use Illuminate\Database\Eloquent\Model;

class FormSubmissionGroup extends BaseModel
{
    protected $table = 'form_submission_groups';
    protected $fillable = [
		'name',
		'description',
		'form_submission_id',
		'is_added_to_template',
		'created_by',
		'updated_by'
	];

	/**
	 * Retrieve group's fields
	 *
	 * @return Collection
	 */
    public function formFields()
    {
        return $this->hasMany(FormSubmissionField::class, 'form_submission_group_id', 'id');
    }

    public function formFieldsDataAnswer()
    {
        return $this->belongsTo(FormSubmissionField::class, 'form_submission_group_id', 'id');
    }

    public function fomrSubmissionToSupplier() {

        return $this->hasMany(FormSubmissionToSupplier::class, 'form_submission_id', 'form_submission_id');
    }

}
