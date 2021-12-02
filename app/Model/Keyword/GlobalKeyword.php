<?php

namespace App\Model\Keyword;

use App\Model\Keyword\BusinessKeyword;

class GlobalKeyword extends \App\Model\BaseModel
{
    /**
     * Specify attribute here if you want it to not be mass
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [];


    public function businesskeywords()
    {
        return $this->belongsTo(BusinessKeyword::class, 'id', 'global_keyword_id');
    }
}
