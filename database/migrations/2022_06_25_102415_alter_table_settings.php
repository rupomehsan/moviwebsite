<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('website')->nullable()->default(null)->after('developed_by');
            $table->longText('more_social')->nullable()->default(null)->after('youtube');
            $table->string('about_us')->nullable()->default(null)->after('description');
            $table->string('logo_icon')->nullable()->default(null)->after('logo');
            $table->longText('seo_title')->nullable()->default(null)->after('terms_policy');
            $table->longText('meta_description')->nullable()->default(null)->after('terms_policy');
            $table->longText('focus_keyword')->nullable()->default(null)->after('terms_policy');
            $table->longText('seo_tag')->nullable()->default(null)->after('terms_policy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('developed_by');
            $table->dropColumn('more_social');
            $table->dropColumn('about_us');
            $table->dropColumn('logo_icon');
            $table->dropColumn('seo_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('focus_keyword');
            $table->dropColumn('seo_tag');
        });
    }
}
