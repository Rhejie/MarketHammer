<?php

namespace App\Model;

use App\Model\UserType;
use App\Model\User\UserBusiness;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable implements MustVerifyEmail
{
    use
        Notifiable,
        SoftDeletes,
        HasApiTokens,
        HasRoles;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'user_type_id', 'password',
        'image_path', 'created_from_social', 'birth_day', 'is_confirmed', 'email_verified_at', 'created_at', 'updated_at', 'deleted_at', 'device_token'
    ];

    protected $guarded = [];

    protected $appends = ['is_admin', 'is_verified'];

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
            'user_type_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email,NULL,id,deleted_at,NULL',
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'image_path' => 'nullable|string',
            'created_from_social' => 'required|string',
            'birth_day' => 'nullable|string',
            'is_confirmed' => [
                'required',
                Rule::in([1, 0])
            ],
            'created_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
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
            $model->updated_at = $this->utcTimeNow();
        } else {
            $model->created_at = $this->utcTimeNow();
        }
    }

    /**
     * MODEL RELATIONS
     */

    public function cluster()
    {
        return $this->belongsTo(Clusters::class, 'clusterID', 'id');
    }

    /**
     * Return current time in UTC
     *
     * @return \Carbon\Carbon
     */
    public function utcTimeNow()
    {
        date_default_timezone_set('UTC');

        return date('Y-m-d H:i:s');
    }

    /**
     * Retrieve request ip address
     *
     * @return <string>
     */
    public function ipAddress()
    {
        return request()->ip();
    }

    /**
     * Retrieve form data source variable
     *
     * @return <string>
     */
    public function actionSource()
    {
        return request()->input('source');
    }

    public function getIsAdminAttribute()
    {
        $is_admin = false;

        if ($this->usertypeID) {
            $user_type = UserType::whereIsAdmin(1)->whereId($this->usertypeID)->first();
            if ($user_type) {
                $is_admin = true;
            }
        }

        return $is_admin;
    }

    public function getIsVerifiedAttribute()
    {
        $is_verified = false;

        if ($this->email_verified_at) {
            $is_verified = true;
        }

        return $is_verified;
    }

    /*********************
      R E L A T I O N S
     *********************/

    public function userAddress()
    {
        return $this->belongsTo(UserAddresses::class, 'userAddressID', 'id');
    }

    /**
     * Create relation with user types table
     *
     * @return <UserType>
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(UserEvents::class, 'userID', 'id');
    }

    public function coupons()
    {
        return $this->hasMany(UserCoupons::class, 'userID', 'id');
    }

    public function business()
    {
        return $this->belongsToMany(Business::class, 'user_business', 'user_id', 'business_id');
    }

    public function userBusiness()
    {
        return $this->belongsToMany(Business::class, 'user_business', 'user_id', 'business_id');
    }

    public function role()
    {
        return $this->getRoleNames();
    }

    public function isSysAd()
    {
        return $this->hasRole('system_admin');
    }

    public function isSupplier()
    {
        return $this->hasRole('supplier');
    }

    public function isBuyer()
    {
        return $this->hasRole('buyer');
    }

    public function businessFollowing()
    {
        return $this->belongsToMany(Business::class, 'business_follower', 'user_id', 'business_id');
    }

    public function userFollowing()
    {
        return $this->belongsToMany(User::class, 'user_follower', 'follower_id', 'following_id');
    }

    public function userFollowers()
    {
        return $this->belongsToMany(User::class, 'user_follower', 'following_id', 'follower_id');
    }

    public function messages()
    {

        return $this->hasMany(Message::class, 'user_id', 'id');

    }

    /**************************
      E N D  R E L A T I O N S
     **************************/

    /*************************
            S C O P E S
     **************************/
    /**
     * Add query to add additional displayName column in select query
     *
     * @param $query
     *
     * @return <Builder>
     */
    public function scopeDisplayName($query)
    {
        return $query->addSelect(\DB::raw('CONCAT(users.first_name, IF(users.last_name IS NOT NULL, CONCAT(" ", users.last_name), "")) AS displayName'));
    }
    /*************************
        E N D  S C O P E S
     **************************/
}
