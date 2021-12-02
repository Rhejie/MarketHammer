<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@markethammer.com',
                'password' => bcrypt('superadmin'),
                'is_confirmed' => 1,
                'phone' => NULL,
                'email_verified_at' => now()
            )
        ));
        
        
    }
}
