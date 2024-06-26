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
        Schema::create('produk_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->json('data');
            $table->date('tanggal_proses');
            $table->enum('jenis_pembayaran', ['cash', 'transfer']);
            $table->string('bukti_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_masuk');
    }
};
