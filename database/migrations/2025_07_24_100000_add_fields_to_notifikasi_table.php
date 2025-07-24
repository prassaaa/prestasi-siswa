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
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->enum('type', ['info', 'success', 'warning', 'error'])->default('info')->after('pesan');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal')->after('type');
            $table->json('data')->nullable()->after('priority'); // For additional data
            $table->timestamp('read_at')->nullable()->after('dibaca'); // When notification was read
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropColumn(['type', 'priority', 'data', 'read_at']);
        });
    }
};
