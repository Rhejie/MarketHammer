<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use SoftDeletes;

    protected $table = 'events';

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
        'businessListID',
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
            'businessListID' => 'bail|required',
            'name' => 'bail|required|string',
            'description' => 'nullable',
            'startDate' => 'bail|required|date_format:Y-m-d H:i:s',
            'endDate' => 'bail|required|date_format:Y-m-d H:i:s|after:startDate',
            'address' => 'nullable|string',
            'link' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longtitude' => 'nullable|string',
            'created_at' => 'required|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date',
            'is_active' => 'sometimes|in:0,1',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
    }
    
    public function eventMedias() 
    {
    	return $this->hasMany(EventMedias::class, 'eventID', 'id');
    }

    public function business() 
    {
    	return $this->hasOne(BusinessLists::class, 'id', 'businessListID');
    }

    /*************************
            S C O P E S
    **************************/
    /**
     * Append a where clause contraining data with it start and end date
     *
     * @param $query <Builder> - @inherit
     * @param $dates <array> - date constraints
     */
    public function scopeBetweenDates($query, Array $dates)
    {
        $start = $dates['start'];
        $end = $dates['end'];

        $query->whereRaw(
            '"' . $start . '" BETWEEN startDate AND endDate
            OR
            "' . $end . '" BETWEEN startDate AND endDate
            OR
            startDate BETWEEN "' . $start . '" AND "' . $end . '"
            OR
            endDate BETWEEN "' . $start . '" AND "' . $end . '"'
        );
    }
    /*************************
        E N D  S C O P E S
    **************************/
}
