<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAddedToTemplateColumnsToFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submission_fields', function (Blueprint $table) {
            $table->boolean('is_added_to_template')->default(0)->after('is_required')->comment('Checks if this item is added to the form template form structure');
        });

        Schema::table('form_submission_groups', function (Blueprint $table) {
            $table->boolean('is_added_to_template')->default(0)->after('description')->comment('Checks if this item is added to the form template form structure');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('form_submission_fields', function (Blueprint $table) {
		    $table->dropColumn('is_added_to_template');
		});

		Schema::table('form_submission_groups', function (Blueprint $table) {
		    $table->dropColumn('is_added_to_template');
		});
    }
}
