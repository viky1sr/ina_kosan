<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPembayaranBulanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_pembayaran_bulanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('status')->default(0);
            $table->string('payment');
            $table->string('payment_date');
            $table->timestamps();
        });

        Schema::table('info_pembayaran_bulanans', function($table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_virtual_accounts');

            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_virtual_accounts')->references('id')->on('virtual_accounts');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_pembayaran_bulanans');
    }
}
