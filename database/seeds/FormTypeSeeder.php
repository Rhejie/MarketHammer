<?php

use Illuminate\Database\Seeder;

class FormTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('form_types')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE form_types AUTO_INCREMENT = 1;');

        \DB::table('form_types')->insert(array (
            [
                'name' => 'RFQ',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'NDA',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ));

    }
}
