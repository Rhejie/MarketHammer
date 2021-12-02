<?php

use Illuminate\Database\Seeder;
use App\Model\Business;

class PrimaryContactSeeder extends Seeder
{
	

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$businessList = Business::get();
        foreach ($businessList as $business) {
        	//var_dump($business->primary_contact);
        	if($business->primary_contact == ""){
        		$contact = $business->contact->first();
	        	if($contact){
	        		$contact->is_primary = true;
	        		$contact->save();
	        	}
        	}
        }
    }
}