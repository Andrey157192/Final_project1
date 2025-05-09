<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik', 16);
            $table->string('address');
            $table->enum('status', ['Menikah', 'Belum Menikah']);
            $table->date('checkin');
            $table->date('checkout');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
}
