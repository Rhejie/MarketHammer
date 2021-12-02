<?php

namespace App\Model\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\QSAList;
use App\Model\Business;

class BusinessQsa extends Model
{
    
    protected $table = 'business_qsa';
    protected $guarded = ['id'];

    /**
	 * MODEL RELATIONS
     */

    public function qsaDetail() {
        return $this->belongsTo(QSAList::class, 'qsa_detail_id');
    }

    public function business() {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
