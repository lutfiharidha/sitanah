<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoTanahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_tanah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto');
            $table->bigInteger('tanah_id')->unsigned();
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
        Schema::dropIfExists('foto_tanah');
    }
}
