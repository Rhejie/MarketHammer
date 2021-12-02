<?php

use Illuminate\Database\Seeder;

class FormTemplateStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('form_template_statuses')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE form_template_statuses AUTO_INCREMENT = 1;');

        \DB::table('form_template_statuses')->insert(array (
            [
                'code' => 'draft',
                'name' => 'Draft',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'code' => 'published',
                'name' => 'Published',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ));
    }
}
