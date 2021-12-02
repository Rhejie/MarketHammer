<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMaterialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('material', function(Blueprint $table)
		{
			$table->foreign('material_group_id', 'material_material_group_id')->references('id')->on('material_group')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('material_type_id', 'material_material_type_id')->references('id')->on('material_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('material', function(Blueprint $table)
		{
			$table->dropForeign('material_material_group_id');
			$table->dropForeign('material_material_type_id');
		});
	}

}
