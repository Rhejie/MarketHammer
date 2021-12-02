<?php 

namespace App\Repositories\Business;

use App\Repositories\Repository;
use App\Model\Setting\BusinessLevel;

class BusinessLevelRepository extends Repository
{
	/**
     * Instancetiate the class.
     *
     * @param $model <BusinessLevel> - the model class that this repository will be handling
     */
    public function __construct(BusinessLevel $model)
    {
        parent::__construct($model);
    }

    public function create($params)
    {

        $bl = $this->model::create([
            'name' => $params->name,
            'level' => $params->level,
            'description' => $params->description
        ]);

        if ($bl) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($bl);
            }
        }

        return $bl->loadMissing(['translations']);
    }

    public function update($id, $params)
    {
        $bl = $this->model::find($id);
        $bl->update([
            'name' => $params->name,
            'level' => $params->level,
            'description' => $params->description
        ]);

        if ($bl) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($bl);
            }
        }

        return $bl->loadMissing(['translations']);
    }
}