<?php

use App\Model\MaterialType;
use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Steel'],
            ['name' => 'Iron'],
            ['name' => 'Aluminum'],
            ['name' => 'Magnesium'],
            ['name' => 'Coper'],
            ['name' => 'Brass'],
            ['name' => 'Bronze'],
            ['name' => 'Zinc'],
            ['name' => 'Titanium'],
            ['name' => 'Tungsten'],
            ['name' => 'Adamantium'],
            ['name' => 'Nickel'],
            ['name' => 'Cobalt'],
            ['name' => 'Tin'],
            ['name' => 'Lead'],
            ['name' => 'Silicon'],
        ];

        foreach ($types as $type) {
            MaterialType::create($type);
        }
    }
}
