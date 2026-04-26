<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientNutrition;

class IngredientNutritionSeeder extends Seeder
{
    public function run(): void
    {
        $nutritions = [
            'Tepung Terigu' => [
                'energy' => 364, 'protein' => 10, 'fat' => 1, 'carbs' => 76, 'sugar' => 0.3, 'sodium' => 2
            ],
            'Gula Pasir' => [
                'energy' => 387, 'protein' => 0, 'fat' => 0, 'carbs' => 100, 'sugar' => 100, 'sodium' => 1
            ],
            'Cokelat Bubuk' => [
                'energy' => 228, 'protein' => 20, 'fat' => 13, 'carbs' => 58, 'sugar' => 1.8, 'sodium' => 21
            ],
            'Telur Ayam' => [
                'energy' => 155, 'protein' => 13, 'fat' => 11, 'carbs' => 1.1, 'sugar' => 1.1, 'sodium' => 124
            ],
            'Mentega' => [
                'energy' => 717, 'protein' => 0.9, 'fat' => 81, 'carbs' => 0.1, 'sugar' => 0.1, 'sodium' => 11
            ],
            'Pisang Ambon' => [
                'energy' => 89, 'protein' => 1.1, 'fat' => 0.3, 'carbs' => 23, 'sugar' => 12, 'sodium' => 1
            ],
            'Tepung Panir' => [
                'energy' => 395, 'protein' => 13, 'fat' => 5, 'carbs' => 70, 'sugar' => 5, 'sodium' => 800
            ],
            'Keju Parut' => [
                'energy' => 402, 'protein' => 25, 'fat' => 33, 'carbs' => 1.3, 'sugar' => 0.5, 'sodium' => 620
            ],
            'Minyak Goreng' => [
                'energy' => 884, 'protein' => 0, 'fat' => 100, 'carbs' => 0, 'sugar' => 0, 'sodium' => 0
            ],
            'Kentang Rebus' => [
                'energy' => 87, 'protein' => 1.9, 'fat' => 0.1, 'carbs' => 20, 'sugar' => 0.8, 'sodium' => 6
            ],
            'Ragi Instan' => [
                'energy' => 325, 'protein' => 40, 'fat' => 7, 'carbs' => 41, 'sugar' => 0, 'sodium' => 51
            ],
            'Ikan Roa Asap' => [
                'energy' => 290, 'protein' => 58, 'fat' => 4, 'carbs' => 0, 'sugar' => 0, 'sodium' => 210
            ],
            'Cabai Merah' => [
                'energy' => 40, 'protein' => 2, 'fat' => 0.4, 'carbs' => 9, 'sugar' => 5, 'sodium' => 7
            ],
            'Bawang Merah' => [
                'energy' => 40, 'protein' => 1.1, 'fat' => 0.1, 'carbs' => 9, 'sugar' => 4.2, 'sodium' => 4
            ],
            'Garam' => [
                'energy' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0, 'sugar' => 0, 'sodium' => 38758
            ],
            'Singkong' => [
                'energy' => 160, 'protein' => 1.4, 'fat' => 0.3, 'carbs' => 38, 'sugar' => 1.7, 'sodium' => 14
            ],
        ];

        foreach ($nutritions as $name => $n) {
            $ingredient = Ingredient::where('name', $name)->first();
            if (!$ingredient) continue;

            IngredientNutrition::updateOrCreate(
                ['ingredient_id' => $ingredient->id],
                [
                    'per_100g_energy_kcal' => $n['energy'],
                    'per_100g_protein_g' => $n['protein'],
                    'per_100g_fat_g' => $n['fat'],
                    'per_100g_saturated_fat_g' => $n['saturated_fat'],
                    'per_100g_carbs_g' => $n['carbs'],
                    'per_100g_sugar_g' => $n['sugar'],
                    'sodium_mg' => $n['sodium'],
                ]
            );
        }

        echo "✅ Ingredient nutrition data seeded successfully.\n";
    }
}
