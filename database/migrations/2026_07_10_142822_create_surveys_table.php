<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();

            $table->foreignId('warga_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('pekerjaan');
            $table->integer('penghasilan');
            $table->integer('tanggungan');
            $table->enum('kondisi_rumah', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang Layak']);
            $table->enum('status_rumah', ['Milik Sendiri', 'Kontrak', 'Menumpang']);
            $table->boolean('memiliki_kendaraan');
            $table->boolean('memiliki_bpjs');
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending');
            $table->string('bukti_survey')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};