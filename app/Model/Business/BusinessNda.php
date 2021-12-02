<?php

namespace App\Model\Business;

use App\Model\Business;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Buyer\FormSubmissionToSupplier;

class BusinessNda extends Model
{
    use SoftDeletes;
    protected $table = 'business_nda';
    protected $guarded = ['id'];

    public function business() {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function formSubmissionToSupplier() {
        return $this->belongsTo(FormSubmissionToSupplier::class, 'business_id');
    }
}
