<?php

use Illuminate\Database\Seeder;

class MachineManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('machine_manufacturer')->delete();
        
        \DB::table('machine_manufacturer')->insert(array (
        	[
        		'name' => 'Toshiba',
        		'created_at' => \Carbon::now()
        	],
            [
        		'name' => 'Amada',
        		'created_at' => \Carbon::now()
        	],
            [
                'name' => 'Hanro',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Toyo',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Woobea',
                'created_at' => \Carbon::now()
            ],
        ));
    }
}