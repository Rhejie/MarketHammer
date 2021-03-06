<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserEvents extends Model
{
    protected $table = 'userevents';

    public function event()
    {
    	return $this->hasOne(Events::class, 'id', 'eventID');
    }
}
