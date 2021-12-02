<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessPartnerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_partner', function(Blueprint $table)
		{
			$table->foreign('business_id', 'business_partner_business_id')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_partner', function(Blueprint $table)
		{
			$table->dropForeign('business_partner_business_id');
		});
	}

}
