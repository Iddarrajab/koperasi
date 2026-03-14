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
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')
                ->constrained('pinjaman')
                ->cascadeOnDelete();

            $table->decimal('jumlah_angsuran', 15, 2);
            $table->decimal('sisa_pinjaman', 15, 2);

            $table->enum('status_pembayaran', ['belum', 'lunas'])->default('belum');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};
