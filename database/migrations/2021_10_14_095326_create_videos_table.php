<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('year')->nullable();
            $table->string('duration')->nullable();
            $table->string('duration_sec')->nullable();
            $table->string('video_type')->nullable();
            $table->string('url')->nullable();
            $table->string('video')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_vertical')->nullable();
            $table->string('video_on_off')->nullable();
            $table->string('comment_on_off')->nullable();
            $table->longtext('description')->nullable();
            $table->string('is_series')->nullable();
            $table->integer('series_id')->nullable();
            $table->string('season_id')->nullable();
            $table->string('episod_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('celebrity_id')->nullable();
            $table->string('genre_id')->nullable();
            $table->string('imdb_id')->nullable();
            $table->enum('status', ['inactive', 'active'])->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
