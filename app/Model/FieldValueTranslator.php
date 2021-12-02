<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldValueTranslator extends Model
{
    use SoftDeletes;
    
    protected $table = 'field_value_translator';
    protected $guarded = ['id'];

    
}
