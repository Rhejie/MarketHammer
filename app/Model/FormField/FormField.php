<?php

namespace App\Model\FormField;

class FormField extends \App\Model\BaseModel
{
    /**
     * Specify attribute here if you want it to not be mass
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [];

    /**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;
    /**************************
         M U T A T O R S
     **************************/

    /**
     * Decode field_options value
     *
     * @param $value - the column value from DB
     *
     * @return <array | null>
     */
    public function getFieldOptionsAttribute($value)
    {
        return $value ? json_decode($value) : null;
    }

    /**************************
      E N D  M U T A T O R S
     **************************/

    /*********************
      R E L A T I O N S
     *********************/

    /**
     * Establish one to one relation for form group table
     *
     * @return \App\Models\Role
     */
    public function formGroup()
    {
        return $this->belongsTo(FormFieldGroup::class, 'form_field_group_id');
    }

    /**************************
      E N D  R E L A T I O N S
     **************************/
}
