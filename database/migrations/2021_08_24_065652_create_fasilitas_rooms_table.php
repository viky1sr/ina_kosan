<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('fasilitas_name');
            $table->timestamps();
        });

        Schema::table('fasilitas_rooms', function($table) {
            $table->unsignedBigInteger('id_room_kosans');

            $table->foreign('id_room_kosans')->references('id')->on('room_kosans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas_rooms');
    }
}
