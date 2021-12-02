<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Model\User;


class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Set user 1 as system add
        $user = User::where(['email' => 'superadmin@markethammer.com'])->first();
        $user->assignRole('system_admin');
        //$user->removeRole('system_admin');
        

        //Set sysad role for role-permission
        $systemAdmin = Role::findByName('system_admin');
        $systemAdmin->givePermissionTo('role_permission_list');
        $systemAdmin->givePermissionTo('role_permission_create');
        $systemAdmin->givePermissionTo('role_permission_edit');
        $systemAdmin->givePermissionTo('role_permission_delete');
    }
}