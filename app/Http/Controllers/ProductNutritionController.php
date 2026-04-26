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
            $summary->per_serving_saturated_fat_g ?? 0,
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
            'energy' => $this->getLevel($nutrition['energy_kcal'], 99999, 99999, 'kkal'),
            'sugar' => $this->getLevel($nutrition['sugar_g'], 22.5, 5),
            'fat' => $this->getLevel($nutrition['fat_g'], 17.5, 3),
            'saturated_fat' => $this->getLevel($nutrition['saturated_fat_g'], 5, 3),
            'sodium' => $this->getLevel($nutrition['sodium_mg'], 600, 120, 'mg'),
        ];

        return view('products.nutrition', compact('product', 'nutrition', 'fopnl', 'nutriScore', 'nutriColor'));
    }

    private function getLevel($value, $high, $low, $unit = '')
    {
        if ($high === $low) {
            return ['label' => $value . ' ' . ($unit==''?'g':$unit), 'color' => 'blue'];
        } elseif ($value >= $high) {
            return ['label' => $value . ' ' . ($unit==''?'g':$unit), 'color' => 'red'];
            // return ['label' => 'Tinggi', 'color' => 'red'];
        } elseif ($value > $low) {
            return ['label' => $value . ' ' . ($unit==''?'g':$unit), 'color' => 'yellow'];
        }
        return ['label' => $value . ' ' . ($unit==''?'g':$unit), 'color' => 'green'];
    }
}
