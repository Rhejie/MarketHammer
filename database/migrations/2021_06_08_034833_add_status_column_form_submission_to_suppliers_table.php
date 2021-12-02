<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnFormSubmissionToSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submission_to_suppliers', function (Blueprint $table) {
            $table->enum('status', ['open', 'accept', 'reject'])->default('open')->after('supplier_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_submission_to_suppliers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
