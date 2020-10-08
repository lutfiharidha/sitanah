<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTanah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('alamat');
            $table->text('description')->nullable();
            $table->string('harga');
            $table->string('luas');
            $table->enum('jenis', ['jual', 'sewa']);
            $table->enum('status', ['approved', 'pending', 'banned'])->default('pending');
            $table->text('message')->nullable();
            $table->string('slug');
            $table->string('lat');
            $table->string('lng');
            $table->bigInteger('penjual_id')->unsigned();
            $table->timestamps();

            $table->foreign('penjual_id')->references('id')->on('penjual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanah');
    }
}
