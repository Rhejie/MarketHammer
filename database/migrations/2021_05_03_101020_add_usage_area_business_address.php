<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsageAreaBusinessAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_address', function (Blueprint $table) {
            $table->integer('usage_area_id')->index('business_usage_area_id');
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
        Schema::table('business_address', function (Blueprint $table) {
            $table->dropColumn(['usage_area_id']);
        });
    }
}
