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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('jenis', 20);
            $table->string('operasi', 10);
            $table->bigInteger('jumlah');
            $table->string('payment_proof', 100)->nullable();
            $table->foreignId('paket_id')->nullable();
            $table->enum('status', ['sukses', 'gagal', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
