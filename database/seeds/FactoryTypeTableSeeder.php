<?php

use Illuminate\Database\Seeder;

class FactoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('factory_type')->delete();
        
        \DB::table('factory_type')->insert([
            [
                'id' => 1,
                'name' => 'Wholly Owned',
                'description' => '',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Subcontracted',
                'description' => '',
                'created_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Joint Venture',
                'description' => '',
                'created_at' => now()
            ]
        ]);
    }
}
