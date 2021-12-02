<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFollowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("ALTER TABLE business_follower MODIFY COLUMN status ENUM('view', 'pending', 'accepted') DEFAULT 'pending'");

        //
        DB::statement("ALTER TABLE user_follower MODIFY COLUMN status ENUM('view', 'pending', 'accepted') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
