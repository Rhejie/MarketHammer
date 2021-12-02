<?php

use Illuminate\Database\Seeder;

class FreePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 0,
                'code' => 'FP',
                'name' => 'Free Plan',
                'price' => 0.00,
                'type' => 'Yearly',
                'created_at' => now(),
            ),
        ));
    }
}
