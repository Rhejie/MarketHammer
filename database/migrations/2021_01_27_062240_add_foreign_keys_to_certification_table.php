<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCertificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('certification', function(Blueprint $table)
		{
			$table->foreign('certification_type_id', 'certification_certification_type_id')->references('id')->on('certification_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('governing_org_id', 'certification_governing_organization_id')->references('id')->on('governing_organization')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('certification', function(Blueprint $table)
		{
			$table->dropForeign('certification_certification_type_id');
			$table->dropForeign('certification_governing_organization_id');
		});
	}

}
