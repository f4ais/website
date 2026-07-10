<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_bantuan_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_penyaluran');
            $table->enum('status', ['pending', 'disalurkan', 'ditolak'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};