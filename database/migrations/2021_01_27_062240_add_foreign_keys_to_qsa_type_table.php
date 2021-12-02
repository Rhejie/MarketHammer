<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQsaTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('qsa_type', function(Blueprint $table)
		{
			$table->foreign('qsa_criteria_id', 'qsa_type_qsa_criteria_id')->references('id')->on('qsa_criteria')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('qsa_type', function(Blueprint $table)
		{
			$table->dropForeign('qsa_type_qsa_criteria_id');
		});
	}

}
