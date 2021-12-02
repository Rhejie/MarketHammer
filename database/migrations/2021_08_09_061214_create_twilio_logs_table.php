<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwilioLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twilio_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_type');
            $table->string('log_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->index(['log_type', 'log_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('twilio_logs');
    }
}
