<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCelebrities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('celebrities', function (Blueprint $table) {
            $table->string('file_type')->nullable()->default(null)->after('name');
            $table->string('file_link')->nullable()->default(null)->after('name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('celebrities', function (Blueprint $table) {
            $table->dropColumn('file_type');
            $table->dropColumn('file_link');
        });
    }
}
