<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldValueTranslatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field_value_translator', function(Blueprint $table)
        {
            $table->string('lang_en', 1000)->nullable()->default(null)->change();
            $table->string('lang_ko', 1000)->nullable()->default(null)->change();
            $table->string('lang_jap', 1000)->nullable()->default(null)->change();
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
    }
}
