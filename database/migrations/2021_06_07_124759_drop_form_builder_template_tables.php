<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFormBuilderTemplateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	\DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        Schema::dropIfExists('form_builder_template_form_fields');
        Schema::dropIfExists('form_builder_template_form_groups');

        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

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
