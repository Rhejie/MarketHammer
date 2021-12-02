<?php

namespace App\Model\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Model\MachineType;
use App\Model\MachineManufacturer;
use App\Model\MachineProcessType;

class BusinessMachine extends Model
{

    protected $table = 'business_machine';
    protected $guarded = ['id'];

    /**
     * MODEL RELATIONS
     */

    public function machineType() {
        return $this->hasOne(MachineType::class, 'id', 'machine_type_id');
    }

    public function manufacturer() {
        return $this->hasOne(MachineManufacturer::class, 'id', 'machine_manufacturer_id');
    }

    public function processType() {
        return $this->hasOne(MachineProcessType::class, 'id', 'process_type_id');
    }

    public function customFields() {
        return $this->hasMany(BusinessMachineCustomFields::class, 'business_machine_id', 'id');
    }

}