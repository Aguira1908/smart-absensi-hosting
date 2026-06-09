<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poins', function (Blueprint $table) {
            $table->id();

            // 🔥 WAJIB ADA
            $table->unsignedBigInteger('siswa_id');

            $table->integer('total')->default(0);

            $table->timestamps();

            // 🔥 FIX DI SINI
            $table->foreign('siswa_id')
                  ->references('id')
                  ->on('siswa') // ✅ BUKAN siswas
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poins');
    }
};