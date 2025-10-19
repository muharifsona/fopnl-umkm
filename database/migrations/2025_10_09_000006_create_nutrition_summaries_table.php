<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('nutrition_summaries', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->unique()->constrained()->cascadeOnDelete();
            $t->decimal('per_serving_energy_kcal',10,2)->nullable();
            $t->decimal('per_serving_protein_g',10,2)->nullable();
            $t->decimal('per_serving_fat_g',10,2)->nullable();
            $t->decimal('per_serving_carbs_g',10,2)->nullable();
            $t->decimal('per_serving_sugar_g',10,2)->nullable();
            $t->decimal('per_serving_sodium_mg',10,2)->nullable();
            $t->timestamp('calculated_at')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('nutrition_summaries'); }
};
