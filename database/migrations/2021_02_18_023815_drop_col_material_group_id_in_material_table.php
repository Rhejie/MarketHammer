<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColMaterialGroupIdInMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('material', function(Blueprint $table)
		{
			$table->dropForeign('material_material_group_id');
		});
        
        Schema::table('material', function (Blueprint $table) {
            //
            $table->dropColumn('material_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
