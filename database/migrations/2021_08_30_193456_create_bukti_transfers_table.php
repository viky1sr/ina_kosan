<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuktiTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('status')->default(0);
            $table->unsignedInteger('id_kontrak_sewa')->default(0);
            $table->string('nominal')->nullable();
            $table->string('bukti_transfer');
            $table->timestamps();
        });

        Schema::table('bukti_transfers', function($table) {
            $table->unsignedBigInteger('id_users');

            $table->foreign('id_users')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukti_transfers');
    }
}
