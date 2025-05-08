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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('gambar', 70);
            $table->foreignId('kategori_id');
            $table->string('nama', 100);
            $table->integer('harga');
            $table->integer('triple')->nullable();
            $table->integer('duo')->nullable();
            $table->string('durasi', 7);
            $table->text('deskripsi');
            $table->string('slug', 100);
            $table->date('tanggal_berangkat');
            $table->integer('seat')->nullable();
            $table->integer('total_seat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
