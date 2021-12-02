<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnToCertainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complex_locations', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->default(null)->after('updated_at');
        });

        Schema::table('complex_types', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->default(null)->after('updated_at');
        });

        Schema::table('usage_areas', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->default(null)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complex_locations', function (Blueprint $table) {
            $table->dropColumn(['deleted_at']);
        });

        Schema::table('complex_types', function (Blueprint $table) {
            $table->dropColumn(['deleted_at']);
        });

        Schema::table('usage_areas', function (Blueprint $table) {
            $table->dropColumn(['deleted_at']);
        });
    }
}
