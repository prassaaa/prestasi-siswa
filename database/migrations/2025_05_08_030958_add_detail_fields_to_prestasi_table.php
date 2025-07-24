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
        Schema::table('prestasi', function (Blueprint $table) {
            $table->string('penyelenggara')->nullable()->after('jenis_prestasi');
            $table->string('lokasi_kegiatan')->nullable()->after('penyelenggara');
            $table->date('tanggal_kegiatan')->nullable()->after('lokasi_kegiatan');
            $table->string('kategori_lomba')->nullable()->after('tanggal_kegiatan');
            $table->string('peringkat')->nullable()->after('kategori_lomba');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi', function (Blueprint $table) {
            $table->dropColumn([
                'penyelenggara',
                'lokasi_kegiatan',
                'tanggal_kegiatan',
                'kategori_lomba',
                'peringkat'
            ]);
        });
    }
};
