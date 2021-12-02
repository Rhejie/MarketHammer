<?php

namespace App\Model\Buyer;

use App\Model\FormFieldAnswer;
use App\Model\FormSubmissionGroup;
use Illuminate\Database\Eloquent\Model;
use App\Model\{BaseModel, User, Business};
use App\Model\Business\BusinessNda;

class FormSubmissionToSupplier extends BaseModel
{
    //
    protected $fillable = ['form_submission_id', 'buyer_id', 'supplier_id', 'status'];

    public function supplier()
    {
        return $this->belongsTo(Business::class, 'supplier_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function formSubmission()
    {
        return $this->belongsTo(FormSubmissions::class, 'form_submission_id', 'id');
    }

    public function supplierData() {
        return $this->belongsTo(Business::class, 'supplier_id', 'id')->select(['id', 'legal_name', 'image_url', 'email']);
    }

    public function answerSubmission(){
        return $this->hasMany(FormFieldAnswer::class, 'form_submission_to_supplier_id', 'id');
    }

    public function requestNda() {
        return $this->hasOne(BusinessNda::class, 'form_submission_to_supplier_id');
    }

    public function fromGroup() {
        return $this->hasMany(FormSubmissionGroup::class, 'form_submission_id', 'form_submission_id');
    }
}
