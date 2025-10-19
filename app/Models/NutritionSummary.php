<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NutritionSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'per_serving_energy_kcal','per_serving_protein_g','per_serving_fat_g',
        'per_serving_carbs_g','per_serving_sugar_g','per_serving_sodium_mg',
        'calculated_at'
    ];
    public function product() { return $this->belongsTo(Product::class); }
}
