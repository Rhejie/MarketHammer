<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldValueTranslatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_value_translator', function (Blueprint $table) {
            $table->id();
            $table->string('table', 200);
            $table->string('field', 200);
            $table->string('value', 1000);
            $table->string('lang_en', 1000);
            $table->string('lang_ko', 1000);
            $table->string('lang_jap', 1000);
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
        Schema::dropIfExists('field_value_translator');
    }
}
