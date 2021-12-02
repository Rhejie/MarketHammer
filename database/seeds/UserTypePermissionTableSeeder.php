<?php


use Illuminate\Database\Seeder;
use App\Model\Business;
use App\Model\Permission\UserTypePermission;
use App\Model\Permission\BusinessUserTypePermission;
use App\Repositories\Permission\BusinessUserTypePermissionRepository;


class UserTypePermissionTableSeeder extends Seeder
{

    public function __construct(BusinessUserTypePermissionRepository $businessUserTypePermissionRepository)
    {
        $this->businessUserTypePermissionRepository = $businessUserTypePermissionRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
            [
                'code' => '_general_view_',
                'name' => 'General',
            ],
            [
                'code' => '_contact_view_',
                'name' => 'Contacts',
            ],
            [
                'code' => '_address_view_',
                'name' => 'Addresses',
            ],
            [
                'code' => '_product_view_',
                'name' => 'Products',
            ],
            [
                'code' => '_machine_view_',
                'name' => 'Machines',
            ],
            [
                'code' => '_certification_view_',
                'name' => 'Certifications',
            ],
            [
                'code' => '_partner_view_',
                'name' => 'Partners',
            ],
            [
                'code' => '_material_view_',
                'name' => 'Materials',
            ],
            [
                'code' => '_substance_view_',
                'name' => 'Substances',
            ],
            [
                'code' => '_finance_view_',
                'name' => 'Finances',
            ],
        ];


        foreach ($permissions as $permission) {
            $userPermission = UserTypePermission::create($permission);
        }
        
        BusinessUserTypePermission::truncate();
        //Seed default business permission for each business
        $businessList = Business::get();
        foreach ($businessList as $business) {
            $this->businessUserTypePermissionRepository->seedDefaultBusinessPermission($business->id);
        }

    }
}