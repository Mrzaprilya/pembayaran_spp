<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('spp_id');

            $table->date('tgl_bayar');
            $table->string('bulan_dibayar');
            $table->string('tahun_dibayar');
            $table->integer('jumlah_bayar');

            $table->timestamps();

            $table->foreign('petugas_id')
                ->references('id')
                ->on('petugas')
                ->onDelete('cascade');

            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswa')
                ->onDelete('cascade');

            $table->foreign('spp_id')
                ->references('id')
                ->on('spp')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
