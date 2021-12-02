<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexFieldValueTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('state', function (Blueprint $table) {
            $table->index(['country_id', 'code']);
        });

        Schema::table('country', function (Blueprint $table) {
            $table->index(['country_code', 'currency']);
        });

        Schema::table('field_value_translator', function (Blueprint $table) {
            $table->index(['table_id', 'table']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('state', function (Blueprint $table) {
            $table->dropIndex(['country_id', 'code']); 
        });

        Schema::table('country', function (Blueprint $table) {
            $table->dropIndex(['country_code', 'currency']); 
        });

        Schema::table('field_value_translator', function (Blueprint $table) {
            $table->dropIndex(['table_id', 'table']); 
        });
    }
}
