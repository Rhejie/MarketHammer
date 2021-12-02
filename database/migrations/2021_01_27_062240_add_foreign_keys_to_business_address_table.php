<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_address', function(Blueprint $table)
		{
			$table->foreign('address_type_id', 'business_address_address_type_id')->references('id')->on('address_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('factory_type_id', 'business_address_factory_type_id')->references('id')->on('factory_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_address', function(Blueprint $table)
		{
			$table->dropForeign('business_address_address_type_id');
			$table->dropForeign('business_address_factory_type_id');
		});
	}

}
