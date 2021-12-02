<?php

use Illuminate\Database\Seeder;

class SupplierStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('supplier_statuses')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE supplier_statuses AUTO_INCREMENT = 1;');

        \DB::table('supplier_statuses')->insert(array (
            [
                'name' => 'Prospect',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Profile Received',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Questionnaire Sent',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'NDA signed',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'MOU sealed',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
        ));

    }
}
