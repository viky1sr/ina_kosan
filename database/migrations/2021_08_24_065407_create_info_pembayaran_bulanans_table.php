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
            $table->unsignedInteger('id_users')->default(0);
            $table->unsignedInteger('id_virtual_accounts')->default(0);
            $table->unsignedInteger('status')->default(0);
            $table->string('payment');
            $table->string('payment_date');
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
        Schema::dropIfExists('info_pembayaran_bulanans');
    }
}
