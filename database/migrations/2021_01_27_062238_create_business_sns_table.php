<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessSnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_sns', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('business_id')->index('business_sns_business_id');
			$table->integer('sns_id')->index('business_sns_sns_id');
			$table->string('account_info', 200)->nullable();
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
		Schema::drop('business_sns');
	}

}
