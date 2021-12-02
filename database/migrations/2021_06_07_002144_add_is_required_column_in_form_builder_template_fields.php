<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRequiredColumnInFormBuilderTemplateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_builder_template_form_fields', function (Blueprint $table) {
            // $table->boolean('is_required')->default(false)->after('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_builder_template_form_fields', function (Blueprint $table) {
            //
        });
    }
}
