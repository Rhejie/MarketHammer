<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->index('business_materials_business_id');
            $table->integer('material_id')->index('business_materials_material_id');
            $table->timestamps();

            $table->foreign('business_id', 'business_materials_business_id')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('material_id', 'business_materials_material_id')->references('id')->on('material')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     *
     */
    public function down()
    {
        Schema::dropIfExists('business_materials');
        Schema::table('business_materials', function (Blueprint $table) {
            $table->dropForeign('business_materials_business_id');
            $table->dropForeign('business_materials_material_id');
        });
    }
}
