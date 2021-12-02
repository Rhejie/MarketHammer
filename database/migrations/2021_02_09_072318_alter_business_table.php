<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        if (Schema::hasColumn('business', 'status'))
        {
            Schema::table('business', function (Blueprint $table)
            { 
                $table->dropColumn('status');
            });

        }

        if (Schema::hasColumn('business', 'num_of_employees'))
        {
            Schema::table('business', function (Blueprint $table)
            { 
                $table->dropColumn('num_of_employees');
            });

        }

        if (Schema::hasColumn('business', 'rnd_staff'))
        {
            Schema::table('business', function (Blueprint $table)
            { 
                $table->dropColumn('rnd_staff');
            });

        }

        if (Schema::hasColumn('business', 'employee_count_id'))
        {
            Schema::table('business', function (Blueprint $table)
            { 
                $table->dropColumn('employee_count_id');
            });

        }

        if (Schema::hasColumn('business', 'rnd_staff_count_id'))
        {
            Schema::table('business', function (Blueprint $table)
            { 
                $table->dropColumn('rnd_staff_count_id');
            });

        }
        

        Schema::table('business', function (Blueprint $table) {
            
            $table->enum('status', ['public', 'private'])->default('private')->after('date_established');
            $table->integer('employee_count_id')->nullable()->after('fax');
            $table->integer('rnd_staff_count_id')->nullable()->after('employee_count_id');

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
