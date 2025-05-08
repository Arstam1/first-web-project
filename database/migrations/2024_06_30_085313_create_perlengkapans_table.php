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
        Schema::create('perlengkapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('paket_id');
            $table->foreignId('transaksi_id');
            $table->enum('batik', ['iya', 'tidak'])->default('tidak');
            $table->enum('ihram', ['iya', 'tidak'])->default('tidak');
            $table->enum('tpasport', ['iya', 'tidak'])->default('tidak');
            $table->enum('tsandal', ['iya', 'tidak'])->default('tidak');
            $table->enum('koper', ['iya', 'tidak'])->default('tidak');
            $table->enum('syal', ['iya', 'tidak'])->default('tidak');
            $table->enum('buku', ['iya', 'tidak'])->default('tidak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perlengkapans');
    }
};
