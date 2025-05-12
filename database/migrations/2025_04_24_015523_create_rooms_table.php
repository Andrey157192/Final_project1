<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->integer('created_by');
        $table->string('rooms_type');
        $table->decimal('price');
        $table->text('description');
        $table->string('picture');
        $table->integer('kapasitas')->default(1);
        $table->decimal('harga_per_malam', 10, 2);
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};