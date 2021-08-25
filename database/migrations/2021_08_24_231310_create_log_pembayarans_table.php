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
            $table->unsignedInteger('id_users')->default(0);
            $table->unsignedInteger('id_room_kosans')->default(0);
            $table->unsignedInteger('id_virtual_accounts')->default(0);
            $table->unsignedInteger('id_info_pembayaran')->default(0);
            $table->unsignedInteger('id_kontrak_sewas')->default(0);
            $table->string('status');
            $table->string('total_pembayaran');
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
        Schema::dropIfExists('log_pembayarans');
    }
}
