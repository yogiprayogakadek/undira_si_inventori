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
        Schema::create('produk_keluar', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            // $table->foreignId('produk_id')->references('id')->on('produk')->onDelete('cascade');
            // $table->enum('kategori', ['keluar', 'masuk']);
            // $table->integer('jumlah');
            $table->json('data');
            $table->date('tanggal_proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_keluar');
    }
};
