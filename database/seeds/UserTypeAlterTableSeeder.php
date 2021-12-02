<?php


use Illuminate\Database\Seeder;
use App\Model\UserType;


class UserTypeAlterTableSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Update names and codes for user type

		$userType = UserType::find(1);
		$userType->code = 'buyer';
		$userType->name = 'Buyer';
		$userType->save();


		$userType = UserType::find(2);
		$userType->code = 'supplier';
		$userType->name = 'Supplier';
		$userType->save();

	}
}