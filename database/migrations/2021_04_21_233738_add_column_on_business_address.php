<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnBusinessAddress extends Migration
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
            $table->string('manufacturer_area_size')->nullable()->after('phone');
            $table->string('incidental_area_size')->nullable()->after('manufacturer_area_size');
            $table->string('building_area_size')->nullable()->after('incidental_area_size');
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
        Schema::table('business_address', function (Blueprint $table)
        { 
            $table->dropColumn('manufacturer_area_size');
            $table->dropColumn('incidental_area_size');
            $table->dropColumn('building_area_size');
        });
    }
}
