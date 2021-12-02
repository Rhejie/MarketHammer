<?php

namespace App\Repositories\OperationCondition;

use App\Repositories\Repository;
use App\Model\OperationCondition;

class OperationConditionRepository extends Repository
{
    public function __construct(OperationCondition $model)
    {
        parent::__construct($model);
    }

    public function get($params)
    {
        if ($params->search) {
            $operationConditions = $this->model()->where(function ($query) use ($params) {
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $operationConditions = $this->model()->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $operationConditions;
    }

    public function create($params)
    {

        $operationCondition = $this->model::create([
            'name' => $params->name,
            'description' => $params->description,
        ]);

        if ($operationCondition) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($operationCondition);
            }
        }

        return $operationCondition->loadMissing(['translations']);
    }

    public function update($id, $params)
    {
        $operationCondition = $this->model::find($id);
        $operationCondition->update([
            'name' => $params->name,
            'description' => $params->description,
        ]);

        if ($operationCondition) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($operationCondition);
            }
        }

        return $operationCondition->loadMissing(['translations']);
    }
}
