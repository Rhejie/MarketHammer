<?php

namespace App\Repositories\SupplierStatus;

use App\Repositories\Repository;
use App\Model\SupplierStatus;

class SupplierStatusRepository extends Repository
{
    public function __construct(SupplierStatus $model)
    {
        parent::__construct($model);
    }

    public function get($params)
    {
        if ($params->search) {
            $supplierStatuses = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $supplierStatuses = $this->model()->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $supplierStatuses;
    }

    public function create($params)
    {

        $supplierStatus = $this->model::create([
            'name' => $params->name
        ]);

        if ($supplierStatus) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($supplierStatus);
            }
        }

        return $supplierStatus->loadMissing(['translations']);
    }

    public function update($id, $params)
    {
        $supplierStatus = $this->model::find($id);
        $supplierStatus->update([
            'name' => $params->name,
        ]);

        if ($supplierStatus) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($supplierStatus);
            }
        }

        return $supplierStatus->loadMissing(['translations']);
    }
}
