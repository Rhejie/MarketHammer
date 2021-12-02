z<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddMachineTypeBarcode extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {

            Schema::table('machine_process_type', function (Blueprint $table) {
                $table->string('bar_code', 200);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('machine_process_type', function (Blueprint $table) {
                $table->dropColumn(['bar_code']);
            });
        }
    }
