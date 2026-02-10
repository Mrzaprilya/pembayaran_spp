<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spp', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->enum('kategori', ['normal', 'kip', 'yatim']);
            $table->integer('nominal');
            $table->date('tanggal_berlaku')->nullable(); // Tanggal mulai berlaku
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spp');
    }
};
