<?php

namespace App\Repositories\SystemData;

use App\Repositories\Repository;
use App\Model\Country;

class CountryRepository extends Repository
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function updateCountry(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                if ($this->hasTranslationData()) {
                    $this->updateFieldTranslations($model);
                }

                \DB::commit();

                return $this->model->with(['translations'])->where(['id' => $model->id])->first();
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

    /**
     * Retrieve the list of currencies from the countries table
     * 
     * @return <array>
     */
    public function getAllCurrencies()
    {
        return $this->model->get()->only(['currency'])->all();
    }
}