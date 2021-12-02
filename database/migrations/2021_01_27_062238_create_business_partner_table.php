<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessPartnerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_partner', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('business_id')->index('business_partner_business_id');
			$table->string('type', 200)->nullable();
			$table->string('company_name', 200);
			$table->string('website', 200)->nullable();
			$table->date('partner_since')->nullable();
			$table->string('contact_person', 200)->nullable();
			$table->string('contact_email', 200)->nullable();
			$table->string('contact_phone', 200)->nullable();
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
		Schema::drop('business_partner');
	}

}
