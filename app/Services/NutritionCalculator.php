<?php

namespace App\Services;

use App\Models\Product;
use App\Models\NutritionSummary;
use Carbon\Carbon;

class NutritionCalculator
{
    public static function calculate(Product $product)
    {
        $ingredients = $product->ingredients()->with('nutrition')->get();

        // Jika produk belum punya komposisi
        if ($ingredients->isEmpty()) {
            // Hapus summary lama (jika ada)
            NutritionSummary::where('product_id', $product->id)->delete();
            return null;
        }

        // Inisialisasi total
        $totals = [
            'energy_kcal' => 0,
            'protein_g' => 0,
            'fat_g' => 0,
            'carbs_g' => 0,
            'sugar_g' => 0,
            'sodium_mg' => 0,
        ];

        // Hitung total per 100g
        foreach ($ingredients as $ing) {
            if (!$ing->nutrition) continue;

            $factor = ($ing->pivot->quantity_g ?? 0) / 100;

            $totals['energy_kcal'] += ($ing->nutrition->per_100g_energy_kcal ?? 0) * $factor;
            $totals['protein_g']   += ($ing->nutrition->per_100g_protein_g ?? 0) * $factor;
            $totals['fat_g']       += ($ing->nutrition->per_100g_fat_g ?? 0) * $factor;
            $totals['carbs_g']     += ($ing->nutrition->per_100g_carbs_g ?? 0) * $factor;
            $totals['sugar_g']     += ($ing->nutrition->per_100g_sugar_g ?? 0) * $factor;
            $totals['sodium_mg']   += ($ing->nutrition->sodium_mg ?? 0) * $factor;
        }

        // Simpan ke tabel nutrition_summaries
        NutritionSummary::updateOrCreate(
            ['product_id' => $product->id],
            [
                'per_serving_energy_kcal' => $totals['energy_kcal'],
                'per_serving_protein_g'   => $totals['protein_g'],
                'per_serving_fat_g'       => $totals['fat_g'],
                'per_serving_carbs_g'     => $totals['carbs_g'],
                'per_serving_sugar_g'     => $totals['sugar_g'],
                'per_serving_sodium_mg'   => $totals['sodium_mg'],
                'calculated_at'           => Carbon::now(),
            ]
        );

        // Kembalikan hasil ke controller
        return $totals;
    }
}
