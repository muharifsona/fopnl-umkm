<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientNutrition;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Tepung Terigu',
                'nutrition' => [
                    'per_100g_energy_kcal' => 364,
                    'per_100g_protein_g'   => 10.0,
                    'per_100g_fat_g'       => 1.0,
                    'per_100g_carbs_g'     => 76.0,
                    'per_100g_sugar_g'     => 0.3,
                    'sodium_mg'            => 2,
                ]
            ],
            [
                'name' => 'Pisang Ambon',
                'nutrition' => [
                    'per_100g_energy_kcal' => 90,
                    'per_100g_protein_g'   => 1.0,
                    'per_100g_fat_g'       => 0.3,
                    'per_100g_carbs_g'     => 23.0,
                    'per_100g_sugar_g'     => 12.0,
                    'sodium_mg'            => 1,
                ]
            ],
            [
                'name' => 'Gula Pasir',
                'nutrition' => [
                    'per_100g_energy_kcal' => 400,
                    'per_100g_protein_g'   => 0,
                    'per_100g_fat_g'       => 0,
                    'per_100g_carbs_g'     => 100,
                    'per_100g_sugar_g'     => 100,
                    'sodium_mg'            => 0,
                ]
            ],
            [
                'name' => 'Telur Ayam',
                'nutrition' => [
                    'per_100g_energy_kcal' => 155,
                    'per_100g_protein_g'   => 13.0,
                    'per_100g_fat_g'       => 11.0,
                    'per_100g_carbs_g'     => 1.0,
                    'per_100g_sugar_g'     => 0.5,
                    'sodium_mg'            => 124,
                ]
            ],
            [
                'name' => 'Mentega',
                'nutrition' => [
                    'per_100g_energy_kcal' => 717,
                    'per_100g_protein_g'   => 0.9,
                    'per_100g_fat_g'       => 81.0,
                    'per_100g_carbs_g'     => 0.1,
                    'per_100g_sugar_g'     => 0.1,
                    'sodium_mg'            => 11,
                ]
            ],
            [
                'name' => 'Baking Powder',
                'nutrition' => [
                    'per_100g_energy_kcal' => 53,
                    'per_100g_protein_g'   => 0,
                    'per_100g_fat_g'       => 0,
                    'per_100g_carbs_g'     => 28.0,
                    'per_100g_sugar_g'     => 0,
                    'sodium_mg'            => 11300,
                ]
            ],
            [
                'name' => 'Garam',
                'nutrition' => [
                    'per_100g_energy_kcal' => 0,
                    'per_100g_protein_g'   => 0,
                    'per_100g_fat_g'       => 0,
                    'per_100g_carbs_g'     => 0,
                    'per_100g_sugar_g'     => 0,
                    'sodium_mg'            => 38758,
                ]
            ],
        ];

        foreach ($data as $item) {
            $ingredient = Ingredient::create([
                'name' => $item['name'],
                'default_measure' => 'g',
            ]);

            IngredientNutrition::create(array_merge(
                ['ingredient_id' => $ingredient->id],
                $item['nutrition']
            ));
        }
    }
}
