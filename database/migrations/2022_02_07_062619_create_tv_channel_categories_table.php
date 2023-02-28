<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvChannelCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('tv_channel_categories')) {
            Schema::create('tv_channel_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('image')->nullable();
                $table->enum('status', ['inactive', 'active'])->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_channel_categories');
    }
}
