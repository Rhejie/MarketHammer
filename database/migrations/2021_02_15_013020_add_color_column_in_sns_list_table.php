<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorColumnInSnsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sns_list', function (Blueprint $table) {
            $table->string('color')->nullable()->default(null)->after('website')->description('The primary color of the social media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sns_list', function (Blueprint $table) {
            //
        });
    }
}
