<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormBuilderTemplateFormGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_builder_template_form_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_builder_field_group_id');
            $table->unsignedBigInteger('form_submission_id');
            $table->unsignedBigInteger('buyer_form_template_id');
            $table->integer('level');
            $table->integer('position');
            $table->unsignedBigInteger('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_builder_template_form_groups');
    }
}
