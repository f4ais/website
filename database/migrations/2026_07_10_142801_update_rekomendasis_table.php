<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rekomendasis', function (Blueprint $table) {

            $table->renameColumn('skor', 'nilai_akhir');

            $table->integer('ranking')->nullable()->after('nilai_akhir');

            $table->dropColumn('catatan');

        });
    }

    public function down(): void
    {
        Schema::table('rekomendasis', function (Blueprint $table) {

            $table->renameColumn('nilai_akhir', 'skor');

            $table->dropColumn('ranking');

            $table->text('catatan')->nullable();

        });
    }
};