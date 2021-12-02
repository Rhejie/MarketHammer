<?php

namespace App\Repositories\Translation;

use App\Repositories\Repository;
use App\Model\FieldValueTranslator;

class FieldValueTranslatorRepository extends Repository
{
    public function __construct(FieldValueTranslator $model)
    {
        parent::__construct($model);
    }

    public function storeTranslation()
    { }
}
