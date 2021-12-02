<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyFollowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_follower', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('business');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_follower', function (Blueprint $table) {
            $table->foreign('following_id')->references('id')->on('users');
            $table->foreign('follower_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
