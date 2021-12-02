<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBusinessMachineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_machine', function (Blueprint $table) {
            $table->dropColumn('process_type');
        });
        Schema::table('business_machine', function (Blueprint $table) {
            $table->integer('machine_type_id')->index('business_machine_machine_type_id')->after('machine_manufacturer_id');
            $table->integer('process_type_id')->index('business_machine_process_type_id')->after('machine_type_id');
        });
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
