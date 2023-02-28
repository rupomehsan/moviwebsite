<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('duration_hour')->nullable()->default(null)->after('year');
            $table->string('slug')->nullable()->default(null)->after('url');
            $table->string('type')->nullable()->default(null)->after('url');
            $table->string('trailer')->nullable()->default(null)->after('url');
            $table->string('send_notification')->nullable()->default(null)->after('video_on_off');
            $table->string('series_category_id')->nullable()->default(null)->after('is_series');
            $table->longText('director')->nullable()->default(null)->after('genre_id');
            $table->longText('writer')->nullable()->default(null)->after('genre_id');
            $table->string('show_tmdb')->nullable()->default(null)->after('imdb_id');
            $table->string('tmdb_type')->nullable()->default(null)->after('imdb_id');
            $table->string('tmdb_rating')->nullable()->default(null)->after('imdb_id');
            $table->longText('seo_title')->nullable()->default(null)->after('status');
            $table->longText('meta_description')->nullable()->default(null)->after('status');
            $table->longText('focus_keyword')->nullable()->default(null)->after('status');
            $table->longText('seo_tag')->nullable()->default(null)->after('status');
            $table->string('is_trending')->nullable()->default(null)->after('comment_on_off');
            $table->string('fake_view')->nullable()->default(null)->after('comment_on_off');
            $table->string('is_parental')->nullable()->default(null)->after('comment_on_off');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('duration_hour');
            $table->dropColumn('slug');
            $table->dropColumn('type');
            $table->dropColumn('trailer');
            $table->dropColumn('send_notification');
            $table->dropColumn('series_category_id');
            $table->dropColumn('director');
            $table->dropColumn('writer');
            $table->dropColumn('tmdb_type');
            $table->dropColumn('show_tmdb');
            $table->dropColumn('tmdb_rating');
            $table->dropColumn('seo_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('focus_keyword');
            $table->dropColumn('seo_tag');
            $table->dropColumn('is_trending');
            $table->dropColumn('fake_view');
            $table->dropColumn('is_parental');
        });
    }
}
