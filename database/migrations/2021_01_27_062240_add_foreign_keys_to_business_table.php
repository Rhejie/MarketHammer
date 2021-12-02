<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business', function(Blueprint $table)
		{
			$table->foreign('business_category_id', 'business_business_category_id')->references('id')->on('business_category')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('industry_type_id', 'business_industry_type_id')->references('id')->on('industry_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business', function(Blueprint $table)
		{
			$table->dropForeign('business_business_category_id');
			$table->dropForeign('business_industry_type_id');
		});
	}

}
