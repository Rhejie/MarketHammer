<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'USD',
                'name' => 'US Dollar',
                'description' => 'US Dollar',
                'locale_id' => 0,
                'locale_name' => NULL,
                'locale_english_name' => NULL,
                'currency_symbol' => '$',
                'currency_english_name' => NULL,
                'currency_native_name' => NULL,
                'conversion_rate' => 0.0,
                'exchange_rate' => 0.0
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'PHP',
                'name' => 'PH Peso',
                'description' => 'PH Peso',
                'locale_id' => 0,
                'locale_name' => NULL,
                'locale_english_name' => NULL,
                'currency_symbol' => '₱',
                'currency_english_name' => NULL,
                'currency_native_name' => NULL,
                'conversion_rate' => 0.0,
                'exchange_rate' => 0.0
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'KRW',
                'name' => 'KR Won',
                'description' => 'KR Won',
                'locale_id' => 0,
                'locale_name' => NULL,
                'locale_english_name' => NULL,
                'currency_symbol' => '₩',
                'currency_english_name' => NULL,
                'currency_native_name' => NULL,
                'conversion_rate' => 0.0,
                'exchange_rate' => 0.0
            ),
        ));
        
        
    }
}
