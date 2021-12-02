<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessPartner extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'business_partner';
    protected $guarded = ['id'];

    /**
     * Custom validator
     *
     * @return <array | boolean>
     */
    public function validate()
    {
        $messages = $messages = [
            'name.required' => 'Company Name is required.',
            'created_at.required' => 'Created At field is required.',
        ];

        $validator = Validator::make($this->attributes, [
            'name' => 'required|string',
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

    public function parentBusiness() {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
