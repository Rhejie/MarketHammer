<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_keywords', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->unsignedBigInteger('global_keyword_id');
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('business_id')->references('id')->on('business');
            $table->foreign('global_keyword_id')->references('id')->on('global_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_keywords');
    }
}
