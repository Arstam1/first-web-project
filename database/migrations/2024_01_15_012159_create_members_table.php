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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->char('ktp', 16)->nullable();
            $table->string('name', 40)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable();
            $table->string('tempat_lahir', 20)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('RT', 3)->nullable();
            $table->string('RW', 3)->nullable();
            $table->string('kelurahan', 20)->nullable();
            $table->string('kecamatan', 20)->nullable();
            $table->string('kota', 20)->nullable();
            $table->string('proponsi', 30)->nullable();
            $table->string('hp', 15)->nullable();
            $table->string('last_edu', 10)->nullable();
            $table->string('pekerjaan', 30)->nullable();
            $table->string('nama_darurat', 40)->nullable();
            $table->string('alamat_darurat', 50)->nullable();
            $table->string('kontak_darurat', 15)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('edited_by', 40)->nullable();
            $table->char('no_passport', 8)->nullable();
            $table->date('dissue')->nullable();
            $table->string('dexpiry')->nullable();
            $table->string('issuing_office', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
