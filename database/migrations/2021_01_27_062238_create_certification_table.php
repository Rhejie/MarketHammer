<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertificationTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('certification_type_id')->index('certification_certification_type_id');
            $table->integer('governing_org_id')->index('certification_governing_organization_id');
            $table->string('name', 200);
            $table->text('description', 65535)->nullable();
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
        Schema::drop('certification');
    }
}
