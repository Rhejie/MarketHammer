<?php

use Illuminate\Database\Seeder;

class EmployeeCountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('employee_count')->delete();
        
        \DB::table('employee_count')->insert([
            [
                'name' => '1 ~ 10',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => '11 ~ 20',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => '21 ~ 50',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => '51 ~ 100',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
