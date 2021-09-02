<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakSewasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak_sewas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('status')->default(0);
            $table->string('mulai_sewa');
            $table->string('lama_sewa');
            $table->timestamps();
        });

        Schema::table('kontrak_sewas', function($table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_room_kosans');

            $table->foreign('id_users')->references('id')->on('users');
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
        Schema::dropIfExists('kontrak_sewas');
    }
}
