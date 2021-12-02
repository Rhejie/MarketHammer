<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_contact', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('business_id')->index('business_contact_business_id');
			$table->string('name', 200);
			$table->string('title', 200)->nullable();
			$table->string('role', 200)->nullable();
			$table->string('email', 200)->nullable();
			$table->string('phone', 200)->nullable();
			$table->string('fax', 200)->nullable();
			$table->boolean('is_president')->nullable()->default(0);
			$table->boolean('is_primary')->nullable()->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_contact');
	}

}
