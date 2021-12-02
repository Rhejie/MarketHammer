<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
            [
                'name' => 'role_permission_list',
                'type' => 'role_permission'
            ],
            [
                'name' => 'role_permission_create',
                'type' => 'role_permission'
            ],
            [
                'name' => 'role_permission_edit',
                'type' => 'role_permission'
            ],
            [
                'name' => 'role_permission_delete',
                'type' => 'role_permission'
            ],
            [
                'name' => 'general_view',
                'type' => 'general'
            ],
            [
                'name' => 'contact_view',
                'type' => 'contact'
            ],
            [
                'name' => 'address_view',
                'type' => 'address'
            ],
            [
                'name' => 'product_view',
                'type' => 'product'
            ],
            [
                'name' => 'machine_view',
                'type' => 'machine'
            ],
            [
                'name' => 'certification_view',
                'type' => 'certification'
            ],
            [
                'name' => 'partner_view',
                'type' => 'partner'
            ],
            [
                'name' => 'material_view',
                'type' => 'material'
            ],
            [
                'name' => 'substance_view',
                'type' => 'substance'
            ],
            [
                'name' => 'finance_view',
                'type' => 'finance'
            ],
        ];


        foreach ($permissions as $permission) {
             Permission::create($permission);
        }
    }
}