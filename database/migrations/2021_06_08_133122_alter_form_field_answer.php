<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFormFieldAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_field_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id')->after('form_submission_form_field_id');
            $table->unsignedBigInteger('supplier_id')->after('buyer_id');
            $table->unsignedBigInteger('updated_by')->change();
            $table->dropColumn('form_field_id');
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
    }
}
