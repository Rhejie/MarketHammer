<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuyerIdToBuyerFormTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_form_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id')->nullable()->index('buyer_form_templates_buyer_id')->after('id');
        });

        Schema::table('form_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id')->nullable()->index('form_submissions_buyer_id')->after('buyer_form_template_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_form_templates', function (Blueprint $table) {
            $table->dropColumn('buyer_id');
        });
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropColumn('buyer_id');
        });
    }
}
