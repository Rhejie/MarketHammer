<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_permission', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('business_user_type_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type_permission_id')->unsigned();
            $table->integer('user_type_id')->index('business_user_type_permission_user_type_id');
            $table->integer('business_id')->unsigned()->nullable();
            $table->timestamps();

            /*$table->foreign('user_type_permission_id')
                ->references('id')
                ->on('user_type_permission')
                ->onDelete('CASCADE');

            $table->foreign('business_id')
                ->references('id')
                ->on('business')
                ->onDelete('CASCADE');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_type_permission');
        Schema::dropIfExists('business_user_type_permission');
    }
}
