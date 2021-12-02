<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessSnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_sns', function(Blueprint $table)
		{
			$table->foreign('business_id', 'business_sns_business_id')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sns_id', 'business_sns_sns_id')->references('id')->on('sns_list')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_sns', function(Blueprint $table)
		{
			$table->dropForeign('business_sns_business_id');
			$table->dropForeign('business_sns_sns_id');
		});
	}

}
