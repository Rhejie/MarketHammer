<?php

namespace App\Repositories\Translation;

use App\Repositories\Repository;
use App\Model\Setting\Translation;

class TranslationRepository extends Repository
{
    public function __construct(Translation $model)
    {
        parent::__construct($model);
    }
}
