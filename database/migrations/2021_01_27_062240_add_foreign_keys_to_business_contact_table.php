<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_contact', function(Blueprint $table)
		{
			$table->foreign('business_id', 'business_contact_business_id')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_contact', function(Blueprint $table)
		{
			$table->dropForeign('business_contact_business_id');
		});
	}

}
