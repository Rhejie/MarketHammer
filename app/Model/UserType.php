<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $guarded = ['id'];

    /*********************
      R E L A T I O N S
    *********************/

    /**
     * Create relation with users.
     *
     * @return <Collection>
     */  
    public function user()
    {
        return $this->hasMany(User::class);
    }

    /**************************
      E N D  R E L A T I O N S
    **************************/
}
