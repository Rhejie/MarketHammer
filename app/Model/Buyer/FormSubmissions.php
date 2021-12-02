<?php

namespace App\Model\Buyer;

// use App\Model\FormBuilderTemplateFormFields;

use App\Model\BaseModel;
use App\Model\FormSubmissionStatus;
use App\Model\FormType;
use App\Model\Buyer\FormSubmissionToSupplier;
use App\Model\User;
use App\Model\Business\BusinessNda;
use App\Model\FieldValueTranslator;

use Illuminate\Database\Eloquent\Model;

class FormSubmissions extends BaseModel
{
    //
    protected $fillable = ['form_id', 'buyer_form_template_id', 'instruction' ,'form_title', 'refrence_id', 'buyer_id', 'form_submission_status_id', 'form_type_id', 'expiration_date', 'created_by'];

    public function formStatus()
    {
        return $this->belongsTo(FormSubmissionStatus::class, 'form_submission_status_id', 'id');
    }

    public function formType()
    {
        return $this->belongsTo(FormType::class, 'form_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function requestNda() {
        return $this->hasOne(BusinessNda::class, 'form_submission_id');
    }

    public function formGroups()
    {
        return $this->hasMany(FormSubmissionGroup::Class, 'form_submission_id', 'id');
    }

    // public function FormBuilderTemplateField()
    // {
    //     return $this->hasMany(FormBuilderTemplateFormFields::class, 'form_submission_id', 'id');
    // }

    public function FormToSupplierCount()
    {
        return $this->hasMany(FormSubmissionToSupplier::Class, 'form_submission_id', 'id');
    }

    public function FormRecievedSupplierCount() {

        return $this->hasMany(FormSubmissionToSupplier::Class, 'form_submission_id', 'id');

    }

    public function FormDeclinedSupplierCount() {

        return $this->hasMany(FormSubmissionToSupplier::Class, 'form_submission_id', 'id');

    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'form_submissions');
    }

    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'form_submissions');
    }

    /**
     * Retrieve the name translation data of the name field column of the industry type table
     *
     * @return ActiveQuery
     */
    public function nameTranslation()
    {
        return $this->translator()->where('field', 'name');
    }

    /**
     * Retrieve the translation of the description column
     *
     * @return ActiveQuery
     */
    public function descriptionTranslation()
    {
        return $this->translator()->where('field', 'description');
    }
}
