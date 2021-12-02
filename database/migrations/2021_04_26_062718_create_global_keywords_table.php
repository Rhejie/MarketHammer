<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('from_id')->nullable()->default(null);
            $table->string('from')->nullable()->default(null)->comment('If the keword is not created globally, ie. from supplier.');
            $table->string('lang_ko')->nullable()->default(null)->comment('Translate to Korean');
            $table->string('lang_zh')->nullable()->default(null)->comment('Translate to Chinese');
            $table->string('lang_jp')->nullable()->default(null)->comment('Translate to Japanese');
            $table->string('lang_de_de')->nullable()->default(null)->comment('Translate to German');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable()->default();
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
        Schema::dropIfExists('global_keywords');
    }
}
