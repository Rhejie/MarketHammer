<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessCertificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_certification', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('business_id');
			$table->integer('certification_id')->index('business_certification_certification_id');
			$table->string('certification_no', 200)->nullable();
			$table->string('name', 200)->nullable();
			$table->text('description', 65535)->nullable();
			$table->boolean('is_verified')->nullable()->default(1);
			$table->date('issued_date')->nullable();
			$table->date('expiry_date')->nullable();
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
		Schema::drop('business_certification');
	}

}
