<?php


use Illuminate\Database\Seeder;
use App\Model\Setting\AddressType;

class AdditionalAddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Shipping'],
            ['name' => 'Factory1'],
            ['name' => 'Factory2'],
        ];

        foreach ($types as $type) {
            AddressType::create($type);
        }
    }
}
