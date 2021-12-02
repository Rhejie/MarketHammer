<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllowNullSourceTableColumnInFormSubmissionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submission_fields', function (Blueprint $table) {
            $table->string('source_table')->nullable()->after('field_options')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_submission_fields', function (Blueprint $table) {
            //
        });
    }
}
