<?php

namespace App\Repositories\Permission;

use App\Model\Permission\BusinessUserTypePermission;
use App\Repositories\Permission\UserTypePermissionRepository;
use App\Repositories\Repository;

class BusinessUserTypePermissionRepository extends Repository
{

	/**
     * Instancetiate the class.
     *
     * @param $model <BusinessUserTypePermission> - the model class that this repository will be handling
     */
    public function __construct(BusinessUserTypePermission $model, UserTypePermissionRepository $userTypePermissionRepository)
    {
        parent::__construct($model);
        $this->userTypePermissionRepository = $userTypePermissionRepository;
    }

    public function getBusinessPermission($params = null){
        $permission = $this->model();

        if($params && $params->business_id){
            $permission = $permission->where(['business_id' => $params->business_id]);
        }
        else{
            //To get default.
            $permission = $permission->whereNull('business_id');
        }
        
        $permission = $permission->get();

        return $permission;
    }

    /**
     * Function to seed business permission for newly created business supplier
     *
     * @param $business_id 
     */
    public function seedDefaultBusinessPermission($business_id){        
        $permissions = $this->userTypePermissionRepository->all();

        foreach ($permissions as $permission) {

            //Public *user_type_id = -1
            if($permission->code == '_general_view_' || $permission->code == '_contact_view_' || $permission->code == '_product_view_'){
                $arrPublic = ['user_type_permission_id' => $permission->id,
                    'user_type_id' => -1,
                    'business_id' => $business_id];
                $this->create($arrPublic);
            }
            

            //Buyer *user_type_id = 1
            $arrBuyer = ['user_type_permission_id' => $permission->id,
                    'user_type_id' => 1,
                    'business_id' => $business_id];
            $this->create($arrBuyer);


            //Supplier *user_type_id = 2
            $arrSupplier = ['user_type_permission_id' => $permission->id,
                    'user_type_id' => 2,
                    'business_id' => $business_id];
            $this->create($arrSupplier);


            //MH Partner *user_type_id = 0
            $arrPartner = ['user_type_permission_id' => $permission->id,
                    'user_type_id' => 0,
                    'business_id' => $business_id];
            $this->create($arrPartner);
        }
    }
}