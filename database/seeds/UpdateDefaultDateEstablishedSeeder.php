<?php

use Illuminate\Database\Seeder;

class UpdateDefaultDateEstablishedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Business::query()
            ->whereDate('date_established', '1970-01-01')
            ->update([
                'date_established' => NULL,
            ]);
    }
}
