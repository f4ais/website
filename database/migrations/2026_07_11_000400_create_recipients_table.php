<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aid_program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('citizen_id')->constrained()->cascadeOnDelete();
            $table->foreignId('determined_by')->constrained('users')->restrictOnDelete();
            $table->dateTime('determined_at');
            $table->enum('status', ['ditetapkan', 'diproses', 'tersalurkan', 'gagal'])->default('ditetapkan')->index();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['aid_program_id', 'citizen_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('recipients'); }
};
