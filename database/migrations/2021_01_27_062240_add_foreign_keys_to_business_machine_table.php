<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessMachineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_machine', function(Blueprint $table)
		{
			$table->foreign('business_id', 'business_machine_business_id')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('machine_manufacturer_id', 'business_machine_machine_manufacturer_id')->references('id')->on('machine_manufacturer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_machine', function(Blueprint $table)
		{
			$table->dropForeign('business_machine_business_id');
			$table->dropForeign('business_machine_machine_manufacturer_id');
		});
	}

}
