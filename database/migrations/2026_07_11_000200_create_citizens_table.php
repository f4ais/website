<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->string('nik', 16)->unique();
            $table->string('family_card_number', 16);
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->date('birth_date');
            $table->text('address');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('wilayah')->index();
            $table->string('village');
            $table->string('district');
            $table->string('phone')->nullable();
            $table->decimal('income', 15, 2)->default(0);
            $table->unsignedTinyInteger('dependents')->default(0);
            $table->enum('house_condition', ['sangat_tidak_layak', 'tidak_layak', 'cukup', 'layak'])->default('cukup');
            $table->boolean('has_elderly')->default(false);
            $table->boolean('has_disability')->default(false);
            $table->boolean('is_single_parent')->default(false);
            $table->enum('verification_status', ['pending', 'assigned', 'verified', 'rejected'])->default('pending')->index();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('citizens'); }
};
