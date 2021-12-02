<?php

namespace App\Model;

use App\Model\User\UserBusiness;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    protected $table = 'users';

    protected $guarded = ['id'];

    public function userBusiness()
    {
        return $this->hasMany(UserBusiness::class, 'user_id', 'id');
    }
}
