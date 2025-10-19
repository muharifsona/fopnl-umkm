<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngredientNutrition extends Model
{
    use HasFactory;

    protected $table = 'ingredient_nutritions'; // ← penting! gunakan bentuk jamak sesuai migrasi

    protected $fillable = [
        'ingredient_id', 'per_100g_energy_kcal', 'per_100g_protein_g',
        'per_100g_fat_g', 'per_100g_carbs_g', 'per_100g_sugar_g', 'sodium_mg'
    ];

    public function ingredient() {
        return $this->belongsTo(Ingredient::class, 'ingredient_id', 'id');
    }
}
