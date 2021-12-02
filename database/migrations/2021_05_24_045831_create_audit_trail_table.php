<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditTrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('business_id')->nullable()->index('audit_trail_business_id');
            $table->enum('source', ['WEB'])->default('WEB');
            $table->enum('action_type', ['VIEW', 'SEARCH', 'ADD', 'EDIT', 'REMOVE'])->nullable();
            $table->text('details', 65535)->nullable();
            $table->string('ip', 1000)->nullable();
            $table->string('lat', 1000)->nullable();
            $table->string('long', 1000)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_trail');
    }
}
