<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('en');
            $table->string('ko')->nullable()->default(null)->comment('Korean');
            $table->string('zh')->nullable()->default(null)->comment('Chinese');
            $table->string('jp')->nullable()->default(null)->comment('Japanese');
            $table->string('de_de')->nullable()->default(null)->comment('German(de_DE)');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
