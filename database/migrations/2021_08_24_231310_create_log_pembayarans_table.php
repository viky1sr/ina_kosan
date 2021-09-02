<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('total_pembayaran');
            $table->timestamps();
        });

        Schema::table('log_pembayarans', function($table) {
            $table->unsignedBigInteger('id_room_kosans');
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_virtual_accounts');
            $table->unsignedBigInteger('id_kontrak_sewas');
            $table->unsignedBigInteger('id_info_pembayaran');

            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_virtual_accounts')->references('id')->on('virtual_accounts');
            $table->foreign('id_room_kosans')->references('id')->on('room_kosans');
            $table->foreign('id_kontrak_sewas')->references('id')->on('kontrak_sewas');
            $table->foreign('id_info_pembayaran')->references('id')->on('info_pembayaran_bulanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_pembayarans');
    }
}
