<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('plans')->delete();
        
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'P1',
                'name' => 'Plan 1',
                'price' => 50.00,
                'type' => 'Yearly',
                'created_at' => now(),
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'P2',
                'name' => 'Plan 2',
                'price' => 30.00,
                'type' => 'Yearly',
                'created_at' => now(),
            ),
        ));
    }
}
