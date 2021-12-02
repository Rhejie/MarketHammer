<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('certification', function (Blueprint $table) {

			$table->dropForeign('certification_certification_type_id');
			$table->dropForeign('certification_governing_organization_id');

            $table->renameColumn('governing_org_id', 'certification_holder_id');
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
