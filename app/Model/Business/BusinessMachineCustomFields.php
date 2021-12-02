<?php

namespace App\Model\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class BusinessMachineCustomFields extends Model
{

    protected $table = 'business_machine_custom_fields';
    protected $guarded = ['id'];

    /**
     * MODEL RELATIONS
     */

    public function businessMachine() {
        return $this->belongsTo(BusinessMachine::class, 'business_machine_id');
    }

}