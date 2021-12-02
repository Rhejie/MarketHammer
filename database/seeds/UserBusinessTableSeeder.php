<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Model\User;


class UserBusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add supplier, buyer, and buyer/supplier user
        \DB::table('users')->insert(array (
            0 =>array (
                'id' => 2,
                'user_type_id' => 3,
                'first_name' => 'Supplier',
                'last_name' => 'Admin',
                'email' => 'supplier@markethammer.com',
                'password' => bcrypt('supplier'),
                'is_confirmed' => 1,
                'phone' => NULL,
                'email_verified_at' => now()
            ),
            1 =>array (
                'id' => 3,
                'user_type_id' => 2,
                'first_name' => 'Buyer',
                'last_name' => 'Admin',
                'email' => 'buyer@markethammer.com',
                'password' => bcrypt('buyer'),
                'is_confirmed' => 1,
                'phone' => NULL,
                'email_verified_at' => now()
            ),
            2 =>array (
                'id' => 4,
                'user_type_id' => 6,
                'first_name' => 'Supplier Buyer',
                'last_name' => 'Admin',
                'email' => 'supplier_buyer@markethammer.com',
                'password' => bcrypt('supplier_buyer'),
                'is_confirmed' => 1,
                'phone' => NULL,
                'email_verified_at' => now()
            )
        ));

        //Set role
        $supplier = User::where(['email' => 'supplier@markethammer.com'])->first();
        $supplier->assignRole('supplier');

        $buyer = User::where(['email' => 'buyer@markethammer.com'])->first();
        $buyer->assignRole('buyer');

        $supplier_buyer = User::where(['email' => 'supplier_buyer@markethammer.com'])->first();
        $supplier_buyer->assignRole('supplier');
        $supplier_buyer->assignRole('buyer');


        //Add business to user supplier
        \DB::table('user_business')->insert(array (
            0 =>array (
                'user_id' => 2,
                'business_id' => 1,
                'created_at' => \Carbon::now()
            ),
            1 =>array (
                'user_id' => 4,
                'business_id' => 4,
                'created_at' => \Carbon::now()
            )
        ));
    }
}
