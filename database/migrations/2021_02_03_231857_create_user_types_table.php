<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        \DB::table('user_types')->insert([
            ['code' => 'user', 'name' => 'User', 'created_at' => \Carbon::now()],
            ['code' => 'company', 'name' => 'Company', 'created_at' => \Carbon::now()],
            ['code' => 'system_admin', 'name' => 'System Admin', 'created_at' => \Carbon::now()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
