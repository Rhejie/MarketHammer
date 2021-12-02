<?php

namespace App\Repositories\FormType;

use App\Repositories\Repository;
use App\Model\FormType;

class FormTypeRepository extends Repository
{
    public function __construct(FormType $model)
    {
        parent::__construct($model);
    }

    public function get($params)
    {
        if ($params->search) {
            $formTypes = $this->model()->where(function ($query) use ($params) {
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $formTypes = $this->model()->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $formTypes;
    }

    public function create($params)
    {

        $formType = $this->model::create([
            'name' => $params->name
        ]);

        if ($formType) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($formType);
            }
        }

        return $formType->loadMissing(['translations']);
    }

    public function update($id, $params)
    {
        $formType = $this->model::find($id);
        $formType->update([
            'name' => $params->name,
        ]);

        if ($formType) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($formType);
            }
        }

        return $formType->loadMissing(['translations']);
    }
}
