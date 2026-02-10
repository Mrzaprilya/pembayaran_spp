<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spp', function (Blueprint $table) {
            $table->date('tanggal_berlaku')->nullable()->after('nominal'); // Tanggal mulai berlaku
            $table->boolean('is_active')->default(true)->after('tanggal_berlaku'); // Status aktif
        });
    }

    public function down(): void
    {
        Schema::table('spp', function (Blueprint $table) {
            $table->dropColumn(['tanggal_berlaku', 'is_active']);
        });
    }
};
