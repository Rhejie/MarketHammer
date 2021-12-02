<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessMachineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_machine', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('business_id')->index('business_machine_business_id');
			$table->integer('machine_manufacturer_id')->index('business_machine_machine_manufacturer_id');
			$table->string('process_type', 200)->nullable();
			$table->string('name', 200);
			$table->text('description', 65535)->nullable();
			$table->string('tonnage', 200)->nullable();
			$table->string('model', 200)->nullable();
			$table->string('age', 200)->nullable();
			$table->string('product_num', 200)->nullable();
			$table->text('equipped', 65535)->nullable();
			$table->text('electrics', 65535)->nullable();
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
		Schema::drop('business_machine');
	}

}
