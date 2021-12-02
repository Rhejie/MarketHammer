<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateFormGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_form_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_field_group_id');
            $table->unsignedBigInteger('buyer_form_template_id');
            $table->integer('level');
            $table->integer('position');
            $table->unsignedBigInteger('created_by');
            $table->dateTime('updated_by')->nullable()->default(null);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable()->default(null);
            $table->dateTime('deleted_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_form_groups');
    }
}
