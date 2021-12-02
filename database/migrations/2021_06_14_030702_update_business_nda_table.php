<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusinessNdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_nda', function($table) {
            $table->integer('supplier_id')->nullable()->after('business_id');
            $table->integer('form_submission_id')->after('supplier_id')->nullable();
            $table->integer('form_submission_to_supplier_id')->after('supplier_id')->nullable();
        });

        Schema::table('business_nda', function($table) {
            $table->dropColumn('sender_user_id');
            $table->dropColumn('receiver_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_nda', function($table) {
            $table->dropColumn('supplier_id');
            $table->dropColumn('form_submission_id');
            $table->dropColumn('form_submission_to_supplier_id');
        });
    }
}
