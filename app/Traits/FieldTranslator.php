<?php

namespace App\Traits;

use App\Model\FieldValueTranslator;

trait FieldTranslator
{
    /**
     * Check if the given array of data contains a ``translations`` key
     * This is usefull to check if the post information will be saving translation data
     *
     * @return <boolean>
     */
    public function hasTranslationData()
    {
        return request()->has('translations');
    }

    /**
     * Store translation values of the given fields. This will accepts an array of to translate fields.
     *
     * @param $ref <object> - the reference table data that are being translated
     * @param $translations <array || null> - the array of to translate fields
     *
     * @return <boolean>    
     */
    public function storeFieldTranslations($ref, array $translations = null)
    {
        $translations = !!$translations ? $translations : request()->input('translations');

        foreach ($translations as $key => $trans) {
            $model = new FieldValueTranslator;

            $field = $trans['field'];

            $model->table_id = $ref->id;
            $model->table = $trans['table'];
            $model->field = $field;
            $model->value = $ref->$field ?? '';
            $model->lang_en = $trans['lang_en'];
            $model->lang_ko = $trans['lang_ko'];
            $model->lang_jap = $trans['lang_jap'];
            $model->created_at = __utc_time_now();

            if (!$model->save()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Update translation values of the given fields. This will accepts an array of to translate fields.
     *
     * @param $ref <object> - the reference table data that are being translated
     * @param $translations <array || null> - the array of to translate fields
     *
     * @return <boolean>    
     */
    public function updateFieldTranslations($ref, array $translations = null)
    {
        $translations = !!$translations ? $translations : request()->input('translations');

        foreach ($translations as $key => $trans) {
            $hasId = isset($trans['id']) && $trans['id'];
            $field = $trans['field'];

            $model = $hasId ? FieldValueTranslator::find($trans['id']) : new FieldValueTranslator;
            $model->table_id = $ref->id;
            $model->table = $trans['table'];
            $model->field = $field;
            $model->value = $ref->$field ?? '';
            $model->lang_en = $trans['lang_en'];
            $model->lang_ko = $trans['lang_ko'];
            $model->lang_jap = $trans['lang_jap'];

            $hasId ? $model->updated_at = __utc_time_now() : $model->created_at = __utc_time_now();

            if (!$model->save()) {
                return false;
            }
        }

        return true;
    }
}