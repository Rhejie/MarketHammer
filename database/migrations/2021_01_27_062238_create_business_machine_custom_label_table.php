<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessMachineCustomLabelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_machine_custom_label', function(Blueprint $table)
		{
			$table->integer('int', true);
			$table->integer('business_machine_id')->index('business_machine_custom_label_business_machine_id');
			$table->string('label', 200);
			$table->text('value', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_machine_custom_label');
	}

}
