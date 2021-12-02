<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventMedias extends Model
{
	use SoftDeletes;

 	protected $table = 'eventmedias';   

 	/**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;

 	/**
     * Specify attribute here if you want it to not be mass 
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [
        'eventID',
        'created_at'
    ];

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
        $validator = Validator::make($this->attributes, [
            'eventID' => 'bail|required',
            'mediaPath' => 'bail|required|string',
            'created_at' => 'required|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
    }

 	public function event()
 	{
 		return $this->belongsTo(Events::class, 'eventID', 'id');
 	}
}
