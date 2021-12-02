<?php

namespace App\Repositories\Product;
use App\Repositories\Repository;

use App\Model\ProductCategories;

class ProductCategoryRepository extends Repository {

    public function __construct(ProductCategories $model)
    {
        parent::__construct($model);
    }
}