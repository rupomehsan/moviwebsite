<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episods', function (Blueprint $table) {
            $table->id();
            $table->integer('series_id')->nullable();
            $table->integer('season_id')->nullable();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('episods');
    }
}
