<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FormBuilderField extends Model
{
    //
    protected $fillable = ['form_builder_field_group_id', 'is_link_to_table', '	table_name', 'table_column',  'form_submission_id', 'field_label', 'field_type', 'field_description', 'field_options', 'created_by', 'updated_by'];

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

    public function formBuilderFieldGroup()
    {

        return $this->belongsTo(FormBuilderFieldGroup::class, 'form_builder_field_group_id', 'id');
    }
}
