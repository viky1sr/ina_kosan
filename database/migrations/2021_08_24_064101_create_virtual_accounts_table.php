<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('status')->default(0);
            $table->string('code_virtual');
            $table->string('tanggal_lahir');
            $table->string('saldo');
            $table->string('code_pin');
            $table->timestamps();
        });

        Schema::table('virtual_accounts', function($table) {
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
        Schema::dropIfExists('virtual_accounts');
    }
}
