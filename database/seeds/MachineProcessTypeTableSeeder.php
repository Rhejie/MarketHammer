<?php

use Illuminate\Database\Seeder;

class MachineProcessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('machine_process_type')->delete();
        // reset auto increment to zero
        DB::statement('ALTER TABLE machine_process_type AUTO_INCREMENT = 1;');

        \DB::table('machine_process_type')->insert(array(
            /*[
                'name' => 'diecasting',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'cnc',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'XRF',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Moisture Sensitivity',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Temperature',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Humidity',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Bias',
                'created_at' => \Carbon::now()
            ],*/
            [
                'name' => 'Casting',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Labeling',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Painting',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Moulding',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Forming',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Machining',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Joining',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Additive Manufacturing',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'QC',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'Other',
                'created_at' => \Carbon::now()
            ],
        ));
    }
}
