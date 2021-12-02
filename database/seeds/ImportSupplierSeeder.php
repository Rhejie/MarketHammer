<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $businesses = DB::table('business')
            ->select(['email', 'phone'])
            ->whereNotNull('email')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.email = business.email');
            })
            ->get();

        $userItems = [];

        foreach ($businesses->unique('email') as $business) {
            $exEmail = explode('@', $business->email);
            $userItems[] = [
                'user_type_id' => 2,
                'first_name' => $exEmail[0],
                'last_name' => " ",
                'email' => $business->email,
                'phone' => $business->phone,
                'password' => bcrypt("12341234"),
                'created_from_social' => 'regular',
                'is_confirmed' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($userItems, 500) as $chunk) {
            DB::table('users')->insert($chunk);
        }

    }
}
