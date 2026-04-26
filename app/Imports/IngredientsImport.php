<?php

namespace App\Imports;

use App\Models\Ingredient;
use App\Models\IngredientNutrition;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IngredientsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (!$row['name']) continue; // skip baris kosong

            $ingredient = Ingredient::updateOrCreate(
                ['name' => $row['name']],
                [
                    'default_measure' => $row['default_measure'] ?? 'g',
                    'notes' => $row['notes'] ?? null,
                ]
            );

            IngredientNutrition::updateOrCreate(
                ['ingredient_id' => $ingredient->id],
                [
                    'per_100g_energy_kcal' => $row['per_100g_energy_kcal'] ?? 0,
                    'per_100g_protein_g' => $row['per_100g_protein_g'] ?? 0,
                    'per_100g_fat_g' => $row['per_100g_fat_g'] ?? 0,
                    'per_100g_saturated_fat_g' => $row['per_100g_saturated_fat_g'] ?? 0,
                    'per_100g_carbs_g' => $row['per_100g_carbs_g'] ?? 0,
                    'per_100g_sugar_g' => $row['per_100g_sugar_g'] ?? 0,
                    'sodium_mg' => $row['sodium_mg'] ?? 0,
                ]
            );
        }
    }
}
