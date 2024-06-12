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
            // $table->foreignId('produk_id')->references('id')->on('produk')->onDelete('cascade');
            // $table->enum('kategori', ['keluar', 'masuk']);
            // $table->integer('jumlah');
            $table->foreignId('pengguna_id')->comment('insert by')->references('id')->on('pengguna')->onDelete('cascade');
            $table->json('data');
            $table->string('nama_customer', 100);
            $table->char('no_telp', 16);
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
