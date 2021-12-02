<?php

namespace App\Model;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Setting\AddressType;

class BusinessAddress extends BaseModel
{
    use SoftDeletes;

    protected $table = 'business_address';
    protected $guarded = ['id'];

    protected $searchable = [
        'address_line_1',
        'city'
    ];

    /**
     * Custom validator
     *
     * @return <array | boolean>
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'business_id' => 'required|integer',
//            'address_type_id' => 'required|integer',
//            'factory_type_id' => 'required|integer',
            'lot_area_size' => 'nullable|string',
            'mfg_area' => 'nullable|string',
            'incidental_area' => 'nullable|string',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state_id' => 'nullable|integer',
            'postal' => 'nullable|string',
            'country_id' => 'nullable|integer',
            'complete_address' => 'nullable|string',
            'phone' => 'nullable|string',
            'created_at' => 'required|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
    }

    /**
     * Bootstrap model
     */
    public static function boot()
    {
        parent::boot();

        self::saving([self::class, 'beforeCreate']);
    }

    /**********************************
       E V E N T S  F U N C T I O N S
     ***********************************/
    /**
     * Saving event handler
     *
     * @param $model <object> - Instance of the model
     * @return <boolean>
     */
    public static function beforeCreate(self $model)
    {
        if ($model->id) {
            $model->updated_at = auth()->user()->utcTimeNow();
        } else {
            $model->created_at = auth()->user()->utcTimeNow();
        }
    }

    /*********************
      R E L A T I O N S
     *********************/

    /**
     * Create relation to retrieve parent business model.
     *
     * @return <Business>
     */
    public function businessList()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Create relation to fetch relative coutry model
     *
     * @return <Country>
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    /**************************
      E N D  R E L A T I O N S
     **************************/

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setCompleteAddressAttribute($value)
    {
        $state = State::find($this->attributes['state_id']);
        $country = Country::find($this->attributes['country_id']);

        $address = ucwords($this->attributes['address_line_1']);
        $address .= $address && $this->attributes['address_line_2'] ? ', ' . ucwords($this->attributes['address_line_2']) : ucwords($this->attributes['address_line_2']);
        $address .= $address && $this->attributes['city'] ? ', ' . ucwords($this->attributes['city']) : ucwords($this->attributes['city']);
        $address .= $address && $state ? ', ' . ucwords($state->name ?? '') : ucwords($state->name ?? '');
        $address .= $address && $country ? ', ' . ucwords($country->name ?? '') : ucwords($country->name ?? '');
        $address .= $address && $this->attributes['postal'] ? ', ' . $this->attributes['postal'] : $this->attributes['postal'];

        $this->attributes['complete_address'] = $address;
    }


    /**
     * SCOPES
     */

    public function scopeIsWithinMaxDistance($query, $coordinates, $radius = 500)
    {

        $haversine = "(6371 * acos(cos(radians(" . $coordinates->lat . "))
			* cos(radians(`latitude`))
			* cos(radians(`longitude`)
			- radians(" . $coordinates->lng . "))
			+ sin(radians(" . $coordinates->lat . "))
			* sin(radians(`latitude`))))";

        return $query->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
