<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivationVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activation_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name_kosan');
            $table->string('no_hp_kosan');
            $table->string('address');
            $table->string('reason');
            $table->string('file_pendukung');
            $table->timestamps();
        });

        Schema::table('activation_vendors', function($table) {
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
        Schema::dropIfExists('activation_vendors');
    }
}
