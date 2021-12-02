<?php

use Illuminate\Database\Seeder;

class CertificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('certification_type')->delete();
        
        \DB::table('certification_type')->insert(array (
        	[
        		'name' => 'Certification',
        		'created_at' => \Carbon::now()
        	],
            [
        		'name' => 'Product Certification',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Awards Certification',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Management System Certification',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Product Test Report',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Patent',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Patent Invention',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Country Restricted Sales Access',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Regulatory Licensing Document',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Pratical Parents',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Appearance Design',
        		'created_at' => \Carbon::now()
        	]
        ));
    }
}
