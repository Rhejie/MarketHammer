<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUpdatedByColumnInTemplateFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_form_fields', function (Blueprint $table) {
            $table->unsignedBigInteger('updated_by')->nullable()->default(null)->change();
        });

        Schema::table('template_form_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('updated_by')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_form_fields', function (Blueprint $table) {
            //
        });
    }
}
