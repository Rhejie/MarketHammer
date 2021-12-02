<?php

namespace App\Model;

use App\Model\Business\BusinessProcesses;
use Illuminate\Database\Eloquent\Model;

class Processes extends \App\Model\BaseModel
{
    //
    protected $fillable = ['process_type_id', 'name', 'description'];

    public function processType()
    {
        return $this->belongsTo(MachineProcessType::class, 'process_type_id', 'id');
    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'processes');
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

    public function businessProcesses()
    {
        return $this->belongsTo(BusinessProcesses::class, 'id', 'processes_id');
    }
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'processes');
    }
}
