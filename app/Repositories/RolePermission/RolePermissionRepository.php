<?php

namespace App\Repositories\RolePermission;
use App\Repositories\Repository;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionRepository {

    public function __construct()
    {
        
    }

    public function getRolePermission($params){

    	$rolePermission = Role::with('permissions')->get();

    	return $rolePermission;
    }

    public function savePermission($params){
    	$permission = $params['permission'];
    	$toSetPermissionModel = null;
    	if(isset($params['role'])){
    		$toSetPermissionModel = Role::findByName($params['role']);
    	}

    	if($toSetPermissionModel){
    		$toSetPermissionModel->givePermissionTo($permission);
    		return true;
    	}

    	return null;
    }

    public function removePermission($params){
    	$permission = $params['permission'];
    	$toSetPermissionModel = null;
    	if(isset($params['role'])){
    		$toSetPermissionModel = Role::findByName($params['role']);
    	}

    	if($toSetPermissionModel){
    		$toSetPermissionModel->revokePermissionTo($permission);
    		return true;
    	}

    	return null;
    }
}