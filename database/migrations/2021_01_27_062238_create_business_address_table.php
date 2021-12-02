<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessAddressTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_address', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('address_type_id')->index('business_address_address_type_id');
            $table->integer('factory_type_id')->index('business_address_factory_type_id');
            $table->string('lot_area_size', 100)->nullable();
            $table->string('mfg_area', 100)->nullable();
            $table->string('incidental_area', 100)->nullable();
            $table->text('address_line_1', 65535)->nullable();
            $table->text('address_line_2', 65535)->nullable();
            $table->text('street', 65535)->nullable();
            $table->string('city', 100)->nullable();
            $table->integer('state_id')->nullable();
            $table->string('postal', 100)->nullable();
            $table->integer('country_id')->nullable();
            $table->text('complete_address', 65535)->nullable();
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
        Schema::drop('business_address');
    }
}
