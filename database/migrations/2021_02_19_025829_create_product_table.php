<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('bar_code', 200)->nullable();
            $table->string('model_no', 200)->nullable();
            $table->string('brand_name', 200)->nullable();
            $table->string('origin', 200)->nullable();
            $table->text('details', 65535)->nullable();
            $table->text('introduction', 65535)->nullable();
            $table->text('features', 65535)->nullable();
            $table->text('specification', 65535)->nullable();
            $table->text('warranty', 65535)->nullable();
			$table->boolean('is_private')->nullable()->default(0);
			$table->integer('unit_of_measure_id');
			$table->integer('master_category_id');
			$table->integer('main_category_id');
			$table->integer('sub_category_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
