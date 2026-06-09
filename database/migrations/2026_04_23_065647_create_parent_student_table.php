<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parent_student', function (Blueprint $table) {
            $table->id();

            // 🔥 kolom
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('siswa_id');

            // 🔥 FK ke users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // 🔥 FIX DI SINI
            $table->foreign('siswa_id')
                  ->references('id')
                  ->on('siswa') // ✅ BUKAN siswas
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parent_student');
    }
};