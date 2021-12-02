<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmarks extends Model
{
	use SoftDeletes;
	
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
            $model->updated_at = auth()->user()->utcTimeNow();
        }
        else {
            $model->created_at = auth()->user()->utcTimeNow();
        }
    }

    /**
	 * MODEL RELATIONS
     */

    public function user() {
		return $this->belongsTo(User::class, 'userID', 'id');
	}

	public function business() {
		return $this->belongsTo(BusinessLists::class, 'businessListID', 'id');
	}
}
