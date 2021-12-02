<?php

namespace App\Model\Keyword;

use App\Model\Keyword\GlobalKeyword;

class BusinessKeyword extends \App\Model\BaseModel
{
    /**
     * Specify attribute here if you want it to not be mass
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [];

    //protected $appends = ['keywordName'];

    /**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;


    public function globalKeywords()
    {
        return $this->hasMany(GlobalKeyword::class, 'id', 'global_keyword_id');
    }


    /*public function getKeywordNameAttribute()
    {
        $keywordName = '';
        //$globalKeyword = \DB::table('global_keywords')->where('id', 1829)->first();
        $globalKeyword = GlobalKeyword::where('name', 'like', 'Wireless com%')->get();
        //$key = BusinessKeyword::where('global_keyword_id', $this->global_keyword_id)->first();
        dd($globalKeyword);
        if ($globalKeyword) {
            $keywordName .= $globalKeyword->name;
        }

        return $keywordName;
    }*/
}
