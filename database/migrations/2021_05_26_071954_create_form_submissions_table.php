<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_form_template_id')->nullable();
            $table->string('form_id')->unique()->nullable();
            $table->String('form_title')->nullable();
            $table->String('refrence_id')->unique()->nullable();
            $table->integer('form_submission_status_id')->nullable();
            $table->integer('form_type')->nullable();
            $table->date('expiration_date');
            $table->integer('created_by');
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
        Schema::dropIfExists('form_submissions');
    }
}
