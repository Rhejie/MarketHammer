<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessCertificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_certification', function(Blueprint $table)
		{
			$table->foreign('certification_id', 'business_certification_certification_id')->references('id')->on('certification')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_certification', function(Blueprint $table)
		{
			$table->dropForeign('business_certification_certification_id');
		});
	}

}
