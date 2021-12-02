<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocusignUriToBusinessNda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_nda', function (Blueprint $table) {
            $table->text('docusign_uri')->after('business_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_nda', function (Blueprint $table) {
            $table->dropColumn('docusign_uri');
        });
    }
}
