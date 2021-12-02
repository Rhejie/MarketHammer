<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('industry_type_id')->index('business_industry_type_id');
            $table->integer('business_category_id')->index('business_business_category_id');
            $table->string('supplier_level', 200)->nullable();
            $table->string('legal_name', 200);
            $table->string('english_name', 200)->nullable();
            $table->string('dba', 200)->nullable();
            $table->date('date_established')->nullable();
            $table->string('status', 200)->nullable();
            $table->string('website', 200)->nullable();
            $table->string('about_us', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('fax', 200)->nullable();
            $table->float('num_of_employees', 10, 0)->nullable();
            $table->float('rnd_staff', 10, 0)->nullable();
            $table->string('eid', 200)->nullable();
            $table->string('eid_certificate', 200)->nullable();
            $table->string('corp_ssn', 200)->nullable();
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
        Schema::drop('business');
    }
}
