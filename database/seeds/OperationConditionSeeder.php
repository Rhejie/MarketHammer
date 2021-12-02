<?php

use Illuminate\Database\Seeder;

class OperationConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('operation_conditions')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE operation_conditions AUTO_INCREMENT = 1;');

        \DB::table('operation_conditions')->insert(array (
            [
                'name' => '100% in Use',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => '50% in Use',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'On Sale',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ));
    }
}
