<?php

namespace App\Model\Business;

use App\Model\Processes;
use Illuminate\Database\Eloquent\Model;

class BusinessProcesses extends Model
{
    //
    protected $fillable = ['business_id', 'processes_id'];

    public function processes()
    {
        return $this->belongsTo(Processes::class, 'processes_id', 'id');
    }
}
