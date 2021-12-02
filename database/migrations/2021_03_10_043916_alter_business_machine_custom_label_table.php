<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBusinessMachineCustomLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('business_machine_custom_label');

        Schema::create('business_machine_custom_fields', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('business_machine_id')->index('business_machine_custom_label_business_machine_id');
            $table->string('label', 200);
            $table->string('type', 200);
            $table->text('value', 65535)->nullable();
            $table->text('option', 65535)->nullable();
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
        //
        Schema::dropIfExists('business_machine_custom_fields');
    }
}
