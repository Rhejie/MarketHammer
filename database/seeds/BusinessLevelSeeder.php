<?php

use Illuminate\Database\Seeder;

class BusinessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('business_levels')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE business_levels AUTO_INCREMENT = 1;');

        \DB::table('business_levels')->insert([
        	[
                'name' => 'Diamond',
                'description' => '',
                'level' => 1,
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Gold',
                'description' => '',
                'level' => 2,
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Silver',
                'description' => '',
                'level' => 3,
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Bronze',
                'description' => '',
                'level' => 4,
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
