<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Setting\CertificationType;
use App\Traits\DataTranslationQuery;

class Certification extends Model
{
    use SoftDeletes, DataTranslationQuery;

    protected $table = 'certification';
    protected $guarded = ['id'];

    /*********************
      R E L A T I O N S
     *********************/
    public function certificationType()
    {
        return $this->belongsTo(CertificationType::class, 'certification_type_id', 'id');
    }

    public function certificationHolder()
    {
        return $this->belongsTo(CertificationHolder::class, 'certification_holder_id', 'id');
    }

    /**
     * Retrieve all list of translations for the certification column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'certification');
    }

    /**************************
      E N D  R E L A T I O N S
     **************************/
}
