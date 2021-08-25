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
            $table->unsignedInteger('id_users')->default(0);
            $table->unsignedInteger('id_room_kosans')->default(0);
            $table->unsignedInteger('status')->default(0);
            $table->string('mulai_sewa');
            $table->string('lama_sewa');
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
        Schema::dropIfExists('kontrak_sewas');
    }
}
