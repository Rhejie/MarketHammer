<?php

use Illuminate\Database\Seeder;

class MaterialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('material_type')->delete();
        
        \DB::table('material_type')->insert(array (
        	[
        		'name' => 'Metal',
        		'created_at' => \Carbon::now()
        	],
            [
        		'name' => 'Plastic',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Wood',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Glass',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Ceramic',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Mineral',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Composite Material',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Paper',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Natural Texile',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Synthetic Textile',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Chemical',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Stone',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Concrete',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Plaster',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Rubber',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Foam',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Semiconductor',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Rare-earths',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Leather',
        		'created_at' => \Carbon::now()
        	],
        	[
        		'name' => 'Fiber',
        		'created_at' => \Carbon::now()
        	]
        ));
    }
}
