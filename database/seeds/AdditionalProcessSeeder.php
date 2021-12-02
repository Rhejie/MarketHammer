<?php

use Illuminate\Database\Seeder;

class AdditionalProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('processes')->insert(array (
            [
                'process_type_id' => 6,
                'name' => 'Turning',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
        ));
    }
}
