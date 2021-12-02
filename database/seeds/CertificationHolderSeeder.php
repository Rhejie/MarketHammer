<?php

use Illuminate\Database\Seeder;

class CertificationHolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('certification_holder')->insert(array(
            [
                'name' => 'BCTC',
                'created_at' => \Carbon::now()
            ],
            [
                'name' => 'WQA',
                'created_at' => \Carbon::now()
            ],
        ));
    }
}
