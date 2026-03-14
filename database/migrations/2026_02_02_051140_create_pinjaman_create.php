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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')
                ->constrained('anggota')
                ->cascadeOnDelete();

            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->integer('tenor'); // bulan
            $table->decimal('bunga', 5, 2); // persen

            $table->decimal('total_pinjaman', 15, 2);
            $table->enum('status_pinjaman', ['aktif', 'lunas'])->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
