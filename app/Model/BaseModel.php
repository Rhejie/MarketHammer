<?php

namespace App\Model;

use App\Traits\DataTranslationQuery;
use App\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes, DataTranslationQuery, FullTextSearch;

    /**
     * Will hold MessageBag from validation
     */
    public $errors = null;
}