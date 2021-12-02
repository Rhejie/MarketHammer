<?php

use Illuminate\Database\Seeder;

class MachineTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('machine_type')->delete();

        \DB::table('machine_type')->insert(array(
            [
                'name' => 'Production Equipment',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Testing Equipment',
                'created_at' => \Carbon::now()
            ],
        ));
    }
}
