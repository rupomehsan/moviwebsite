<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMobileAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_ads', function (Blueprint $table) {
            $table->string('unity_status')->nullable()->default(null)->after('startup_id');
            $table->string('unity_id')->nullable()->default(null)->after('startup_id');
            $table->string('iron_status')->nullable()->default(null)->after('startup_id');
            $table->string('iron_id')->nullable()->default(null)->after('startup_id');
            $table->string('next_status')->nullable()->default(null)->after('startup_id');
            $table->string('next_id')->nullable()->default(null)->after('startup_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_ads', function (Blueprint $table) {
            $table->dropColumn('unity_status');
            $table->dropColumn('unity_id');
            $table->dropColumn('iron_status');
            $table->dropColumn('iron_id');
            $table->dropColumn('next_status');
            $table->dropColumn('next_id');
        });
    }
}
