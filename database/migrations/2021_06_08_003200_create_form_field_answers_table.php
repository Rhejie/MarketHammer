<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_field_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_submission_to_supplier_id');
            $table->unsignedBigInteger('form_field_id');
            $table->unsignedBigInteger('form_submission_form_field_id');
            $table->longText('value')->nullable()->default(null);
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
        Schema::dropIfExists('form_field_answers');
    }
}
