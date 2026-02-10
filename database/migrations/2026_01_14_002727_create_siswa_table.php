<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->unsignedBigInteger('kelas_id');
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->enum('kategori_spp', ['normal','kip','yatim']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('spp_id'); 
            $table->foreign('spp_id')->references('id')->on('spp')->onDelete('cascade');

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
