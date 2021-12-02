<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwilioPayloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twilio_payloads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('twilio_log_id');
            $table->text('payload');
            $table->timestamps();
            $table->index(['twilio_log_id']);
            $table->foreign('twilio_log_id')
                ->references('id')
                ->on('twilio_logs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('twilio_payloads');
    }
}
