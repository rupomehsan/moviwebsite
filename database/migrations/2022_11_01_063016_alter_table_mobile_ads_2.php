<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMobileAds2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_ads', function (Blueprint $table) {
            $table->string('app_lovin_max_status')->nullable()->default(null)->after('startup_id');
            $table->string('app_open_id')->nullable()->default(null)->after('startup_id');
            $table->string('app_open_link')->nullable()->default(null)->after('startup_id');
            $table->string('app_open_image')->nullable()->default(null)->after('startup_id');

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
            $table->dropColumn('app_lovin_max_status');
            $table->dropColumn('app_open_id');
            $table->dropColumn('app_open_link');
            $table->dropColumn('app_open_image');
        });
    }
}
