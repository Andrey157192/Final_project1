<?php

// database/migrations/2025_04_22_000002_create_leaderships_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leaderships', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('photo_path');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderships');
    }
};

