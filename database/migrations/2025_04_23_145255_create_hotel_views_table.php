<?php

// database/migrations/2025_04_22_000003_create_hotel_views_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hotel_views', function (Blueprint $t) {
            $t->id();
            $t->string('photo_path');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_views');
    }
};
