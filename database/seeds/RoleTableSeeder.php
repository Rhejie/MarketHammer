<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roles = [
            [
                'name' => 'buyer',
                'description' => 'Buyer'
            ],
            [
                'name' => 'supplier',
                'description' => 'Supplier'
            ],
            [
                'name' => 'system_admin',
                'description' => 'System Admin'
            ]
        ];


        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}