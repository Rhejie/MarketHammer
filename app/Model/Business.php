<?php

namespace App\Model;

use App\Model\Business\{BusinessMaterial, BusinessFinance};
use App\Model\Keyword\BusinessKeyword;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Model\User\UserBusiness;
use App\Model\Keyword\GlobalKeyword;
use Illuminate\Support\Facades\DB;


class Business extends BaseModel
{

    /**
     * Need to specify the table since it doesn't conform
     * with laravel's snake case convention
     *
     * @var <string>
     */

    protected $table = 'business';

    protected $guarded = ['id'];

    protected $appends = ['address', 'address_line_one', 'address_line_two', 'address_city', 'industry_type', 'registered_at', 'primary_contact', 'latest_revenue', 'category', 'country'];

    protected $casts = [
        'freeParking' => 'boolean',
        'withParking' => 'boolean'
    ];

    protected $searchable = [
        'legal_name',
        'english_name',
        'dba'
    ];

    /**
     * Bootstrap model
     */
    public static function boot()
    {
        parent::boot();

        self::saving([self::class, 'beforeCreate']);
    }

    /**
     * Custom validator
     *
     * @return <array | boolean>
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'industry_type_id' => 'required|integer',
            'business_category_id' => 'required|integer',
            /*'complex_type_id' => 'required|integer',
            'complex_location_id' => 'required|integer',*/
            'supplier_level' => 'nullable|string',
            'legal_name' => 'required|string',
            'english_name' => 'nullable|string',
            'dba' => 'nullable|string',
            'date_established' => 'nullable|date',
            'status' => [
                'required',
                Rule::in(['public', 'private'])
            ],
            'website' => 'nullable|string',
            'about_us' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'fax' => 'nullable|string',
            'employee_count_id' => 'nullable|integer',
            'rnd_staff_count_id' => 'nullable|integer',
            'eid' => 'nullable|string',
            'eid_certificate' => 'nullable|string',
            'eid_file_name_attachment' => 'nullable|string',
            'corp_ssn' => 'nullable|string',
            'image_url' => 'nullable|string',
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
            $model->updated_at = __utc_time_now();
        } else {
            $model->created_at = __utc_time_now();
        }
        if ($model->date_established == '1970-01-01') {
            $model->date_established = NULL;
        }
    }
    /*****************************************
       E N D  E V E N T S  F U N C T I O N S
     *****************************************/

    /*********************
      R E L A T I O N S
     *********************/
    public function contact()
    {
        return $this->hasMany(BusinessContact::class, 'business_id', 'id');
    }

    public function primaryContact()
    {
        return $this->hasOne(BusinessContact::class, 'business_id', 'id');
    }

    public function cluster()
    {
        return $this->belongsTo(Clusters::class, 'clusterID', 'id');
    }

    public function industryType()
    {
        return $this->belongsTo(IndustryType::class, 'industry_type_id', 'id');
    }

    public function businessAddress()
    {
        return $this->hasMany(BusinessAddress::class, 'business_id', 'id');
    }

    public function complexType()
    {
        return $this->belongsTo(ComplexType::class, 'complex_type_id', 'id');
    }

    public function complexLocation()
    {
        return $this->belongsTo(ComplexLocation::class, 'complex_location_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany(BusinessTags::class, 'businessListID', 'id');
    }

    public function businessOperations()
    {
        return $this->hasMany(BusinessOperations::class, 'businessListID', 'id')
            ->where(function ($query) {
                $query->where(['businessoperations.deleted_at' => null]);
            });
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'businessListID', 'id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcements::class, 'businessListID', 'id');
    }

    public function businessFiles()
    {
        return $this->hasMany(BusinessFiles::class, 'businessListID', 'id');
    }

    public function businessStreams()
    {
        return $this->hasMany(LiveVideos::class, 'businessListID', 'id');
    }

    public function userBookmark()
    {
        return $this->hasOne(Bookmarks::class, 'businessListID', 'id')
            ->where(function ($query) {
                $userID = Auth::id() != null  ? Auth::id() : null;
                $query->where(['userID' => $userID, 'bookmarks.deleted_at' => null]);
            });
    }

    public function businessCategory()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id', 'id');
    }

    public function businessEvents()
    {
        return $this->hasMany(Events::class, 'businessListID', 'id');
    }

    public function businessMedias()
    {
        return $this->hasMany(\App\Model\Business\BusinessMedia::class);
    }

    public function businessProducts()
    {
        return $this->belongsToMany(Product::class, 'business_products', 'business_id', 'product_id');
    }

    public function owner()
    {
        return $this->belongsToMany(User::class, 'user_business', 'business_id', 'user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'business_follower', 'business_id', 'user_id');
    }

    public function isFollower()
    {
        return $this->hasOne(\App\Model\Business\BusinessFollower::class, 'business_id', 'id');
    }

    public function businessKeyword()
    {
        return $this->belongsToMany(GlobalKeyword::class, 'business_keywords', 'business_id', 'global_keyword_id')->wherePivot('deleted_at', null);
    }

    public function businessListKeyword()
    {
        return $this->hasMany(BusinessKeyword::class, 'business_id', 'id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'business_materials', 'business_id', 'material_id');
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class, 'business_certification', 'business_id', 'certification_id');
    }

    public function businessCertifications()
    {
        return $this->hasMany(\App\Model\Business\BusinessCertification::class, 'business_id', 'id');
    }

    public function machines()
    {
        return $this->hasMany(\App\Model\Business\BusinessMachine::class, 'business_id', 'id');
    }

    public function userBusiness()
    {
        return $this->belongsTo(UserBusiness::class, 'id', 'business_id');
    }

    public function nda()
    {
        return $this->hasOne(\App\Model\Business\BusinessNda::class, 'business_id', 'id');
    }

    public function rfq(){
        return $this->belongsToMany(\App\Model\Buyer\FormSubmissions::class, 'form_submission_to_suppliers', 'supplier_id', 'form_submission_id');
    }

    public function answerForms() {
        return $this->hasMany(\App\Model\FormFieldAnswer::class, 'supplier_id', 'id');
    }

    public function formSubmissionToSupplier() {
        return $this->belongsTo(\App\Model\Buyer\FormSubmissionToSupplier::class, 'id', 'supplier_id');
    }

    /**************************
      E N D  R E L A T I O N S
     **************************/

    /**
     * ACCESSORS
     */
    public function getIndustryTypeAttribute()
    {
        $industryType = '';

        if ($this->industry_type_id) {
            $industryType = IndustryType::where('id', $this->industry_type_id)->first();
            if ($industryType == null) {
                $industryType = '';
            } else {
                $industryType = $industryType->name;
            }
        }
        return $industryType;
    }


    public function getPrimaryContactAttribute()
    {
        $contact = '';
        $businessContact = BusinessContact::where(['business_id' => $this->id, 'is_primary' => 1])->first();
        if ($businessContact) {
            $contact .= $businessContact->name;
        }
        return $contact;
    }

    public function getRegisteredAtAttribute()
    {
        $date = '';
        if ($this->created_at) {
            $date = $this->created_at->format('Y-m-d');
        }
        return $date;
    }

    public function getAddressAttribute()
    {
        $address = '';
        $businessAddress = BusinessAddress::where(['business_id' => $this->id])->first();
        if ($businessAddress) {
            //$address .= $businessAddress->city;
            $address .= $businessAddress->address_line_1. ', ' . $businessAddress->city;
            if ($businessAddress->country_id) {
                $country = Country::find($businessAddress->country_id);
                $address .= ', ' . $country->name;
            }
        }
        return $address;
    }

    public function getAddressLineOneAttribute()
    {
        $street = '';
        $businessAddress = BusinessAddress::where(['business_id' => $this->id])->first();
        if ($businessAddress) {
            $street .= $businessAddress->address_line_1;
        }
        return $street;
    }

    public function getAddressLineTwoAttribute()
    {
        $street_two = '';
        $businessAddress = BusinessAddress::where(['business_id' => $this->id])->first();
        if ($businessAddress) {
            $street_two .= $businessAddress->address_line_2;
        }
        return $street_two;
    }

    public function getAddressCityAttribute()
    {
        $city = '';
        $businessAddress = BusinessAddress::where(['business_id' => $this->id])->first(['city']);
        if ($businessAddress) {
            $city .= $businessAddress->city;
        }

        return $city;
    }

    public function getCountryAttribute()
    {
        $country = '';
        $businessAddress = BusinessAddress::where(['business_id' => $this->id])->first();
        if ($businessAddress) {
            if ($businessAddress->country_id) {
                $getCountry = Country::find($businessAddress->country_id);
                $country = $getCountry ? $getCountry->name : "";
            }
        }
        return $country;
    }


    public function getLatestRevenueAttribute()
    {
        $year = date('Y', strtotime(__utc_time_now()));
        $revenue = "";
        $businessFinance = BusinessFinance::orderBy('year', 'desc')->first(['revenue', 'year']);
        if ($businessFinance) {
            $revenue .= $businessFinance->revenue;
        }

        return $revenue;
    }

    public function getCategoryAttribute()
    {
        $cat = '';
        $businessCat = BusinessCategory::where(['id' => $this->business_category_id])->first();
        if ($businessCat) {
            $cat .= $businessCat->name;
        }
        return $cat;
    }


    /* public function getBusinessBannerAttribute() {
        $mediaPath = null;

        if($this->id) {
            $mediaPath = collect([ 'mediaPath' => asset('image/no_image.png')]);

            $primary = BusinessBanners::where('businessListID', $this->id)->where('is_primary', 1)->first();

            if ($primary != null) {
                $mediaPath = $primary;
            } else {
                $image = BusinessBanners::where('businessListID', $this->id)->latest()->first();
                if ($image != null) {
                    $mediaPath = $image;
                }
            }

        }
        return $mediaPath;
    } */

}
