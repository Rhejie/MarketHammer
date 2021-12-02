<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierStatusIdToBusinessFollower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_follower', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_status_id')->index('business_followers_supplier_statuses_id');

            //$table->foreign('supplier_status_id')->references('id')->on('supplier_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_follwer', function (Blueprint $table) {
            //
        });
    }
}
