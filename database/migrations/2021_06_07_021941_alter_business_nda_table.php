<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBusinessNdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_nda', function($table) {
            $table->string('file_name')->after('name')->nullable();
            $table->integer('business_id')->nullable()->change();
            $table->integer('sender_user_id')->after('docusign_uri')->nullable();
            $table->string('docusign_status')->after('docusign_uri')->nullable();
            $table->integer('receiver_user_id')->after('sender_user_id')->nullable();
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
            $table->dropColumn('file_name');
            $table->dropColumn('sender_user_id');
            $table->dropColumn('receiver_user_id');
        });
    }
}
