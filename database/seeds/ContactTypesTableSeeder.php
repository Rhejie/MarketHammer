<?php

use Illuminate\Database\Seeder;

class ContactTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contacttypes')->delete();

        \DB::table('contacttypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Owner',
                'created_at' => now()
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Manager',
                'created_at' => now()
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Staff',
                'created_at' => now()
            ),
        ));
    }
}
