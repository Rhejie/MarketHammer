<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComplexBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business', function (Blueprint $table) {
            $table->integer('complex_type_id')->index('business_complex_type_id');
            $table->integer('complex_location_id')->index('business_complex_location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('business', function (Blueprint $table) {
            $table->dropColumn(['complex_type_id']);
            $table->dropColumn(['complex_location_id']);
        });
    }
}
