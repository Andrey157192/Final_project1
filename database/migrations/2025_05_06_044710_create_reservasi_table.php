<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai Primary Key
            $table->string('created_by'); // FK ke tabel users (misalnya user yang membuat reservasi)
            $table->string('id_customer'); // FK ke tabel customers
            $table->string('id_rooms'); // FK ke tabel rooms
            $table->date('checkIn_date'); // Kolom untuk tanggal check-in
            $table->date('checkOut_date'); // Kolom untuk tanggal check-out
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
}

