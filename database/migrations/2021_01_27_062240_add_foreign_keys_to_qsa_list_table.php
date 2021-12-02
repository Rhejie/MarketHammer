<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQsaListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('qsa_list', function(Blueprint $table)
		{
			$table->foreign('qsa_type_id', 'qsa_list_qsa_type_id')->references('id')->on('qsa_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('qsa_list', function(Blueprint $table)
		{
			$table->dropForeign('qsa_list_qsa_type_id');
		});
	}

}
