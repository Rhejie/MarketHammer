<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFormBuilderFieldGroupIdToFormSubmissionGroupIdInFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submission_fields', function (Blueprint $table) {
            $table->renameColumn('form_builder_field_group_id', 'form_submission_group_id');
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
