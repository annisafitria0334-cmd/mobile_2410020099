<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->char('kode', 10)->primary();
            $table->string('id_kategori', 20);
            $table->string('nama_produk', 30);
            $table->unsignedInteger('harga_beli');
            $table->unsignedInteger('harga_jual');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
