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
        Schema::create('produk_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->comment('staff')->references('id')->on('pengguna')->onDelete('cascade');
            $table->json('data');
            $table->date('tanggal_request');
            $table->enum('status', ['Menunggu Konfirmasi', 'Approved', 'Ditolak'])->default('Menunggu Konfirmasi')->comment('update oleh admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_request');
    }
};
