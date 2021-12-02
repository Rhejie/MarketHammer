<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQsaTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('qsa_type', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('qsa_criteria_id')->index('qsa_type_qsa_criteria_id');
			$table->string('name', 200);
			$table->text('description', 65535)->nullable();
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
		Schema::drop('qsa_type');
	}

}
