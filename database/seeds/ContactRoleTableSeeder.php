<?php

use Illuminate\Database\Seeder;

class ContactRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('contact_role')->delete();
        // reset auto increment to zero
        DB::statement('ALTER TABLE contact_role AUTO_INCREMENT = 1;');
        
        \DB::table('contact_role')->insert(array (
        	[
        		'name' => 'QC',
        		'created_at' => \Carbon::now()
        	],
            [
        		'name' => 'Sales',
        		'created_at' => \Carbon::now()
        	],
            [
                'name' => 'Accounting',
                'created_at' => \Carbon::now()
            ],
        ));
    }
}