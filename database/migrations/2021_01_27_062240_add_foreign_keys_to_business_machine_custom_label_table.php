<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessMachineCustomLabelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_machine_custom_label', function(Blueprint $table)
		{
			$table->foreign('business_machine_id', 'business_machine_custom_label_business_machine_id')->references('id')->on('business_machine')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_machine_custom_label', function(Blueprint $table)
		{
			$table->dropForeign('business_machine_custom_label_business_machine_id');
		});
	}

}
