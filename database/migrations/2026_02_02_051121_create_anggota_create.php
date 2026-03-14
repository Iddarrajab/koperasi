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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('kode_anggota')->unique();
            $table->string('nomor_anggota')->unique();
            $table->string('nama');
            $table->string('email')->unique();      // Tambahan email
            $table->string('password');             // Tambahan password
            $table->text('alamat');
            $table->string('no_hp');

            $table->enum('status_anggota', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->enum('status_validasi', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');

            $table->foreignId('validated_by')
                ->nullable()
                ->constrained('admin')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
