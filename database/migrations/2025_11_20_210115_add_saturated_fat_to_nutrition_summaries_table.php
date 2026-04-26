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
        Schema::table('nutrition_summaries', function (Blueprint $table) {
            $table->decimal('per_serving_saturated_fat_g', 8, 2)->nullable()->after('per_serving_fat_g');
        });
    }

    public function down(): void
    {
        Schema::table('nutrition_summaries', function (Blueprint $table) {
            $table->dropColumn('per_serving_saturated_fat_g');
        });
    }
};
