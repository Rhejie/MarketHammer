<?php

use Illuminate\Database\Seeder;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('address_type')->delete();

        \DB::table('address_type')->insert([
            [
                'id' => 1,
                'name' => 'Shipping',
                'description' => '',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Billing',
                'description' => '',
                'created_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Design Facility',
                'description' => '',
                'created_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Factory1',
                'description' => '',
                'created_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Factory2',
                'description' => '',
                'created_at' => now()
            ],
        ]);
    }
}
