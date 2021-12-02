<?php

namespace App\Repositories\Permission;

use App\Model\Permission\UserTypePermission;
use App\Repositories\Repository;

class UserTypePermissionRepository extends Repository
{

	/**
     * Instancetiate the class.
     *
     * @param $model <UserTypePermission> - the model class that this repository will be handling
     */
    public function __construct(UserTypePermission $model)
    {
        parent::__construct($model);
    }
}