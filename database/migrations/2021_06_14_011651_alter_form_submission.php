<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFormSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropColumn('instruction');
        });
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->longText('instruction')->nullable()->default(null)->after('expiration_date');
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
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropColumn('instruction');
        });
    }
}
