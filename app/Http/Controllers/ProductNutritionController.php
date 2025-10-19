<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\NutritionCalculator;
use App\Helpers\NutriScoreHelper;

class ProductNutritionController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['productIngredients.ingredient', 'nutritionSummary']);
        $summary = $product->nutritionSummary;

        // 🔹 Hitung Nutri-Score
        $nutriScore = NutriScoreHelper::calculate(
            $summary->per_serving_energy_kcal ?? 0,
            $summary->per_serving_sugar_g ?? 0,
            $summary->per_serving_fat_g ?? 0,
            $summary->per_serving_sodium_mg ?? 0,
            $summary->per_serving_protein_g ?? 0
        );
        $nutriColor = NutriScoreHelper::color($nutriScore);

        // Hitung nilai gizi produk berdasarkan bahan
        $nutrition = NutritionCalculator::calculate($product);

        if (!$nutrition) {
            return redirect()->back()->with('error', 'Belum ada komposisi bahan untuk produk ini.');
        }

        // Hitung tingkat FOPNL berdasarkan batas ambang WHO/ASEAN
        $fopnl = [
            'sugar' => $this->getLevel($nutrition['sugar_g'], 22.5, 5),
            'fat' => $this->getLevel($nutrition['fat_g'], 17.5, 3),
            'sodium' => $this->getLevel($nutrition['sodium_mg'], 600, 120),
        ];

        return view('products.nutrition', compact('product', 'nutrition', 'fopnl', 'nutriScore', 'nutriColor'));
    }

    private function getLevel($value, $high, $low)
    {
        if ($value >= $high) {
            return ['label' => 'Tinggi', 'color' => 'red'];
        } elseif ($value > $low) {
            return ['label' => 'Sedang', 'color' => 'yellow'];
        }
        return ['label' => 'Rendah', 'color' => 'green'];
    }
}
