<?php

use Illuminate\Database\Seeder;

class FormSubmissionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('form_submission_statuses')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE form_submission_statuses AUTO_INCREMENT = 1;');

        \DB::table('form_submission_statuses')->insert(array (
            [
                'name' => 'Open',
            'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'In Progress',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Closed',
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
