<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();

            // 🔥 WAJIB ADA
            $table->unsignedBigInteger('siswa_id');

            $table->date('tanggal');
            $table->enum('jenis', ['izin', 'sakit']);
            $table->text('keterangan');
            $table->string('bukti')->nullable();

            $table->timestamps();

            // 🔥 FOREIGN KEY
            $table->foreign('siswa_id')
                  ->references('id')
                  ->on('siswa')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};