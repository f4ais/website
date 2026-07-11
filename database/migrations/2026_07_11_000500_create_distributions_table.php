<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('distributor_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('distributed_at')->nullable();
            $table->enum('status', ['diproses', 'tersalurkan', 'gagal'])->default('diproses')->index();
            $table->string('documentation_photo')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('distributions'); }
};
