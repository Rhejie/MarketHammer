<?php

namespace App\Model;

use App\Traits\DataTranslationQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineProcessType extends Model
{
    use SoftDeletes, DataTranslationQuery;

    protected $table = 'machine_process_type';
    /**
     * Specify attribute here if you want it to not be mass
     * assinable. By default all attributes are mass assinable.
     *
     * Every attribute is mass assignable
     *
     * @var <array>
     */
    protected $guarded = [];

    /**
     * Will hold MessageBag from validation
     */
    public $errors = null;

    /**
     * Custom validator
     *
     * @return <array | boolean>
     */
    public function validate()
    {
        $messages = $messages = [
            'name.required' => 'Machine Process Type Name is required.',
            'created_at.required' => 'Created At field is required.',
        ];

        $validator = Validator::make($this->attributes, [
            'name' => 'required|string',
            'bar_code' => 'nullable|string',
            'created_at' => 'required|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date'
        ], $messages);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
    }

    /**
     * MODEL RELATIONS
     */

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'machine_process_type');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'machine_process_type');
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

    public function processes()
    {
        return $this->belongsTo(Processes::class);
    }
}
