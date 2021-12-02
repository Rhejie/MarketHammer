<?php

namespace App\Repositories\FormSubmissionStatus;

use App\Repositories\Repository;
use App\Model\FormSubmissionStatus;

class FormSubmissionStatusRepository extends Repository
{
    public function __construct(FormSubmissionStatus $model)
    {
        parent::__construct($model);
    }

    public function get($params)
    {
        if ($params->search) {
            $formStatuses = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $formStatuses = $this->model()->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $formStatuses;
    }

    public function create($params)
    {

        $formStatus = $this->model::create([
            'name' => $params->name
        ]);

        if ($formStatus) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($formStatus);
            }
        }

        return $formStatus->loadMissing(['translations']);
    }

    public function update($id, $params)
    {
        $formStatus = $this->model::find($id);
        $formStatus->update([
            'name' => $params->name,
        ]);

        if ($formStatus) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($formStatus);
            }
        }

        return $formStatus->loadMissing(['translations']);
    }
}
