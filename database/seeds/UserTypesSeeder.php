<?php

use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Set foreign key checker to 0
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        \DB::table('user_types')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE user_types AUTO_INCREMENT = 1;');

        \DB::table('user_types')->insert(array(
            [
                'code' => 'user',
                'name' => 'User',
                'created_at' => \Carbon::now()
            ],
            [
                'code' => 'buyer',
                'name' => 'Buyer',
                'created_at' => \Carbon::now()
            ],
            [
                'code' => 'company',
                'name' => 'Company',
                'created_at' => \Carbon::now()
            ],
            [
                'code' => 'system_admin',
                'name' => 'System Admin',
                'created_at' => \Carbon::now()
            ],
            [
                'code' => 'translator',
                'name' => 'Translator',
                'created_at' => \Carbon::now()
            ],
            [
                'code' => 'user_company',
                'name' => 'Both',
                'created_at' => \Carbon::now()
            ]
        ));

        // Set foreign key checker back to 1
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
