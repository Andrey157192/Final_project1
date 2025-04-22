<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', ['Menikah', 'Belum Menikah'])->nullable();
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'address', 'status', 'checkin', 'checkout']);
        });
    }
};
