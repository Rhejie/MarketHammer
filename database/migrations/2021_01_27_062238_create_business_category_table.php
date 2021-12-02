<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_category', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('industry_type_id')->index('business_category_industry_type_id');
			$table->integer('master_business_category_id')->nullable();
			$table->integer('main_business_category_id')->nullable();
			$table->integer('sub_business_category_id')->nullable();
			$table->string('ko_stat_code', 100)->nullable();
			$table->string('tax_code', 100)->nullable();
			$table->string('sic_code', 100)->nullable();
			$table->string('name', 200);
			$table->text('description', 65535)->nullable();
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
		Schema::drop('business_category');
	}

}
