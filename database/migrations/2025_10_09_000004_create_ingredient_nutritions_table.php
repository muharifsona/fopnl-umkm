<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ingredient_nutritions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained()->cascadeOnDelete();
            $table->decimal('per_100g_energy_kcal', 10, 2)->nullable();
            $table->decimal('per_100g_protein_g', 10, 2)->nullable();
            $table->decimal('per_100g_fat_g', 10, 2)->nullable();
            $table->decimal('per_100g_carbs_g', 10, 2)->nullable();
            $table->decimal('per_100g_sugar_g', 10, 2)->nullable();
            $table->decimal('sodium_mg', 10, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ingredient_nutritions'); }
};
