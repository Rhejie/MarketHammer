<?php

namespace App\Model\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypePermission extends Model
{
    
    protected $table = 'user_type_permission';
    
    protected $guarded = ['id'];

}
