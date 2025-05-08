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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('paket_id');
            $table->bigInteger('jumlah');
            $table->enum('tipe_kamar', ['quad', 'triple', 'duo'])->default('quad');
            $table->integer('total_harga');
            $table->enum('status_visa',['terbit','belum terbit'])->default('belum terbit');
            $table->enum('status_tiket',['terbit','belum terbit'])->default('belum terbit');
            $table->string('status_berangkat')->default('belum berangkat');
            $table->enum('status_pelunasan', ['belum lunas', 'lunas'])->default('belum lunas');
            $table->enum('pengajuan_passport', ['iya', 'tidak'])->default('tidak');
            $table->string('ktp', 100)->nullable();
            $table->string('kk', 100)->nullable();
            $table->string('akta', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
