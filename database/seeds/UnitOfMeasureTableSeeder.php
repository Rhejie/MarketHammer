<?php

use Illuminate\Database\Seeder;

class UnitOfMeasureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('unit_of_measure')->delete();
        
        \DB::table('unit_of_measure')->insert(array (
        	[
        		'name' => 'Dozen',
        		'created_at' => \Carbon::now()
        	],
            [
                'name' => 'Dram',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Fluid Ounce',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Foot',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Forty-Foot Container',
                'created_at' => \Carbon::now()
            ],
        ));
    }
}