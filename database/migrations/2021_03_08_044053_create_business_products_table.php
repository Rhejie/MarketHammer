<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('business_id');
            $table->string('moq', 1000)->nullable();
            $table->string('sample_price', 1000)->nullable();
            $table->string('monthly_ability', 1000)->nullable();
            $table->string('port', 1000)->nullable();
            $table->boolean('is_ready_made')->nullable()->default(0);
            $table->string('pack_details', 1000)->nullable();
            $table->string('rev_last_year', 1000)->nullable();
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
        Schema::dropIfExists('business_products');
    }
}
