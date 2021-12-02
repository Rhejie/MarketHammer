<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_finances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->year('year');
            $table->float('revenue', 10, 2);
            $table->float('ebit', 10, 2)->comment('Earning Before Interest & Taxes');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_finances');
    }
}
