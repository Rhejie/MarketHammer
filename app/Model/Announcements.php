<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    public function businesslists() 
    {
		return $this->belongsTo(BusinessLists::class, 'businessListID', 'id');
    }
}
