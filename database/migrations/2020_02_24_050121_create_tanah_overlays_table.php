<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTanahOverlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanah_overlays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tanah_id');
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();

            $table->foreign('tanah_id')->references('id')->on('tanah');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanah_overlays');
    }
}
