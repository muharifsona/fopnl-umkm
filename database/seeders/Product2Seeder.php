<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\ProductIngredient;
use App\Models\IngredientNutrition;

class Product2Seeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('database/seeders/data/product2_seeder_kuliner_lokal_50_saturated.json');

        if (!file_exists($jsonPath)) {
            echo "❌ File data tidak ditemukan: {$jsonPath}\n";
            return;
        }

        $products = json_decode(file_get_contents($jsonPath), true);

        if (!$products || !is_array($products)) {
            echo "❌ Data JSON tidak valid.\n";
            return;
        }

        foreach ($products as $data) {
            $product = Product::create([
                'user_id' => 4, // khusus regulator UMKM
                'name' => $data['name'],
                'description' => $data['description'],
                'net_weight' => $data['net_weight'],
                'serving_size' => $data['serving_size'],
                'status' => 'draft',
            ]);

            foreach ($data['ingredients'] as $ing) {
                // buat ingredient
                $ingredient = Ingredient::firstOrCreate(
                    ['name' => $ing['name']],
                    ['default_measure' => 'g']
                );

                // buat product_ingredient
                ProductIngredient::create([
                    'product_id' => $product->id,
                    'ingredient_id' => $ingredient->id,
                    'quantity_g' => $ing['quantity'],
                ]);

                // buat atau update ingredient_nutrition
                IngredientNutrition::updateOrCreate(
                    ['ingredient_id' => $ingredient->id],
                    [
                        'per_100g_energy_kcal'      => $ing['per_100g_energy_kcal'],
                        'per_100g_protein_g'        => $ing['per_100g_protein_g'],
                        'per_100g_fat_g'            => $ing['per_100g_fat_g'],
                        'per_100g_saturated_fat_g'  => $ing['per_100g_saturated_fat_g'],
                        'per_100g_carbs_g'          => $ing['per_100g_carbs_g'],
                        'per_100g_sugar_g'          => $ing['per_100g_sugar_g'],
                        'sodium_mg'                 => $ing['sodium_mg'],
                    ]
                );
            }
        }

        echo "✅ 50 Produk dummy + IngredientNutrition berhasil di-seed untuk user_id=4\n";
    }
}
