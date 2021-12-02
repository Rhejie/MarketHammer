<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessFollowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_follower', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->index('business_follower_business_id');
            $table->unsignedBigInteger('user_id')->index('business_follower_user_id');
            $table->timestamp('followed_at')->nullable();
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_follower', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('following_id')->index('user_follower_following_id');
            $table->unsignedBigInteger('follower_id')->index('user_follower_follower_id');
            $table->integer('business_id')->unsigned()->nullable()->index('user_follower_business_id');
            $table->timestamp('followed_at')->nullable();
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_follower');
        Schema::dropIfExists('user_follower');
    }
}
