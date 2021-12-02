<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormBuilderFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_builder_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_submissions_id');
            $table->unsignedBigInteger('form_field_group_id');
            $table->string('field_label');
            $table->string('field_type');
            $table->text('field_description')->nullable()->default(null);
            $table->longText('field_options')->nullable()->default(null);
            $table->boolean('is_link_to_table')->default(0);
            $table->string('table_name')->nullable()->default(null);
            $table->string('table_column')->nullable()->default(null);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable()->default();
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
        Schema::dropIfExists('form_builder_fields');
    }
}
