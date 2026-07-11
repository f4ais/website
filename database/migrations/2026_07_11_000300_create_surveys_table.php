<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained()->cascadeOnDelete();
            $table->foreignId('surveyor_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('scheduled_at')->nullable();
            $table->dateTime('surveyed_at')->nullable();
            $table->enum('status', ['assigned', 'verified', 'rejected'])->default('assigned')->index();
            $table->decimal('verified_income', 15, 2)->nullable();
            $table->enum('verified_house_condition', ['sangat_tidak_layak', 'tidak_layak', 'cukup', 'layak'])->nullable();
            $table->unsignedTinyInteger('verified_dependents')->nullable();
            $table->boolean('verified_has_elderly')->nullable();
            $table->boolean('verified_has_disability')->nullable();
            $table->boolean('verified_is_single_parent')->nullable();
            $table->text('notes')->nullable();
            $table->string('evidence_photo')->nullable();
            $table->unsignedTinyInteger('priority_score')->nullable()->index();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('surveys'); }
};
