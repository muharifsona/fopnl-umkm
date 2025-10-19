<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\ProductIngredient;
use App\Models\IngredientNutrition;

class Product1Seeder extends Seeder
{
    public function run(): void
    {
        // ====== Data nutrisi default per 100g untuk setiap bahan umum ======
        $nutritionDefaults = [
            'Tepung Terigu' => ['per_100g_energy_kcal' => 364, 'per_100g_protein_g' => 10.3, 'per_100g_fat_g' => 1.0, 'per_100g_carbs_g' => 76.0, 'per_100g_sugar_g' => 0.3, 'sodium_mg' => 2],
            'Tepung Beras' => ['per_100g_energy_kcal' => 360, 'per_100g_protein_g' => 6.5, 'per_100g_fat_g' => 0.8, 'per_100g_carbs_g' => 80.0, 'per_100g_sugar_g' => 0.2, 'sodium_mg' => 1],
            'Tepung Gandum' => ['per_100g_energy_kcal' => 340, 'per_100g_protein_g' => 12.0, 'per_100g_fat_g' => 1.2, 'per_100g_carbs_g' => 72.0, 'per_100g_sugar_g' => 1.0, 'sodium_mg' => 3],
            'Gula Pasir' => ['per_100g_energy_kcal' => 387, 'per_100g_protein_g' => 0, 'per_100g_fat_g' => 0, 'per_100g_carbs_g' => 100, 'per_100g_sugar_g' => 100, 'sodium_mg' => 0],
            'Minyak Goreng' => ['per_100g_energy_kcal' => 884, 'per_100g_protein_g' => 0, 'per_100g_fat_g' => 100, 'per_100g_carbs_g' => 0, 'per_100g_sugar_g' => 0, 'sodium_mg' => 0],
            'Garam' => ['per_100g_energy_kcal' => 0, 'per_100g_protein_g' => 0, 'per_100g_fat_g' => 0, 'per_100g_carbs_g' => 0, 'per_100g_sugar_g' => 0, 'sodium_mg' => 38758],
            'Bawang Putih' => ['per_100g_energy_kcal' => 149, 'per_100g_protein_g' => 6.4, 'per_100g_fat_g' => 0.5, 'per_100g_carbs_g' => 33.0, 'per_100g_sugar_g' => 1.0, 'sodium_mg' => 17],
            'Bawang Merah' => ['per_100g_energy_kcal' => 40, 'per_100g_protein_g' => 1.1, 'per_100g_fat_g' => 0.1, 'per_100g_carbs_g' => 9.3, 'per_100g_sugar_g' => 4.2, 'sodium_mg' => 4],
            'Cabai Merah' => ['per_100g_energy_kcal' => 40, 'per_100g_protein_g' => 1.9, 'per_100g_fat_g' => 0.4, 'per_100g_carbs_g' => 8.8, 'per_100g_sugar_g' => 5.3, 'sodium_mg' => 7],
            'Telur Ayam' => ['per_100g_energy_kcal' => 143, 'per_100g_protein_g' => 13, 'per_100g_fat_g' => 9.5, 'per_100g_carbs_g' => 0.7, 'per_100g_sugar_g' => 0.7, 'sodium_mg' => 142],
            'Tempe' => ['per_100g_energy_kcal' => 193, 'per_100g_protein_g' => 20.3, 'per_100g_fat_g' => 10.8, 'per_100g_carbs_g' => 8.8, 'per_100g_sugar_g' => 1.3, 'sodium_mg' => 9],
            'Kecap Manis' => ['per_100g_energy_kcal' => 120, 'per_100g_protein_g' => 4, 'per_100g_fat_g' => 0, 'per_100g_carbs_g' => 24, 'per_100g_sugar_g' => 16, 'sodium_mg' => 3000],
            'Daging Sapi' => ['per_100g_energy_kcal' => 250, 'per_100g_protein_g' => 26, 'per_100g_fat_g' => 15, 'per_100g_carbs_g' => 0, 'per_100g_sugar_g' => 0, 'sodium_mg' => 72],
            'Daging Ayam Suwir' => ['per_100g_energy_kcal' => 239, 'per_100g_protein_g' => 27, 'per_100g_fat_g' => 14, 'per_100g_carbs_g' => 0, 'per_100g_sugar_g' => 0, 'sodium_mg' => 80],
            'Oat' => ['per_100g_energy_kcal' => 389, 'per_100g_protein_g' => 17, 'per_100g_fat_g' => 7, 'per_100g_carbs_g' => 66, 'per_100g_sugar_g' => 1, 'sodium_mg' => 2],
            'Madu' => ['per_100g_energy_kcal' => 304, 'per_100g_protein_g' => 0.3, 'per_100g_fat_g' => 0, 'per_100g_carbs_g' => 82, 'per_100g_sugar_g' => 82, 'sodium_mg' => 4],
            'Kacang Almond' => ['per_100g_energy_kcal' => 579, 'per_100g_protein_g' => 21, 'per_100g_fat_g' => 50, 'per_100g_carbs_g' => 22, 'per_100g_sugar_g' => 4, 'sodium_mg' => 1],
            'Air' => ['per_100g_energy_kcal' => 0, 'per_100g_protein_g' => 0, 'per_100g_fat_g' => 0, 'per_100g_carbs_g' => 0, 'per_100g_sugar_g' => 0, 'sodium_mg' => 0],
        ];

        // ====== Produk dummy UMKM (10 produk baru) ======
        $products = [
            ['name' => 'Keripik Bayam Crispy', 'description' => 'Cemilan renyah dari daun bayam pilihan dengan balutan tepung gurih.', 'net_weight' => 100, 'serving_size' => '20 gram (±5 lembar)', 'ingredients' => [
                ['name' => 'Daun Bayam', 'quantity' => 50],
                ['name' => 'Tepung Terigu', 'quantity' => 30],
                ['name' => 'Tepung Beras', 'quantity' => 10],
                ['name' => 'Bawang Putih', 'quantity' => 5],
                ['name' => 'Minyak Goreng', 'quantity' => 5],
            ]],
            ['name' => 'Tahu Walik Pedas', 'description' => 'Tahu goreng terbalik khas Banyuwangi dengan isian ayam dan cabai.', 'net_weight' => 150, 'serving_size' => '30 gram (2 potong)', 'ingredients' => [
                ['name' => 'Tahu Putih', 'quantity' => 100],
                ['name' => 'Daging Ayam Suwir', 'quantity' => 30],
                ['name' => 'Cabai Merah', 'quantity' => 10],
                ['name' => 'Bawang Putih', 'quantity' => 5],
                ['name' => 'Minyak Goreng', 'quantity' => 5],
            ]],
            ['name' => 'Es Kopi Gula Aren Botol', 'description' => 'Minuman kopi susu dingin dengan campuran gula aren asli.', 'net_weight' => 250, 'serving_size' => '250 ml (1 botol)', 'ingredients' => [
                ['name' => 'Kopi Bubuk Robusta', 'quantity' => 15],
                ['name' => 'Susu Cair', 'quantity' => 200],
                ['name' => 'Gula Aren', 'quantity' => 30],
                ['name' => 'Air', 'quantity' => 5],
            ]],
            ['name' => 'Tempe Orek Kering', 'description' => 'Tempe goreng kering manis gurih dengan bumbu kecap dan cabai.', 'net_weight' => 180, 'serving_size' => '30 gram (3 sendok makan)', 'ingredients' => [
                ['name' => 'Tempe', 'quantity' => 100],
                ['name' => 'Kecap Manis', 'quantity' => 20],
                ['name' => 'Cabai Merah', 'quantity' => 10],
                ['name' => 'Bawang Merah', 'quantity' => 10],
                ['name' => 'Gula Merah', 'quantity' => 10],
                ['name' => 'Minyak Goreng', 'quantity' => 10],
            ]],
            ['name' => 'Keripik Jagung Pedas Manis', 'description' => 'Cemilan jagung goreng gurih dengan bumbu balado manis pedas.', 'net_weight' => 120, 'serving_size' => '25 gram (1 genggam kecil)', 'ingredients' => [
                ['name' => 'Jagung Pipil', 'quantity' => 80],
                ['name' => 'Tepung Beras', 'quantity' => 20],
                ['name' => 'Gula Pasir', 'quantity' => 10],
                ['name' => 'Cabai Bubuk', 'quantity' => 5],
                ['name' => 'Minyak Goreng', 'quantity' => 5],
            ]],
            ['name' => 'Roti Gandum Isi Cokelat', 'description' => 'Roti lembut dari tepung gandum dengan isian cokelat pekat.', 'net_weight' => 250, 'serving_size' => '1 potong (50 gram)', 'ingredients' => [
                ['name' => 'Tepung Gandum', 'quantity' => 100],
                ['name' => 'Cokelat Pasta', 'quantity' => 30],
                ['name' => 'Gula Pasir', 'quantity' => 20],
                ['name' => 'Ragi Instan', 'quantity' => 5],
                ['name' => 'Mentega', 'quantity' => 10],
            ]],
            ['name' => 'Kerupuk Kulit Sapi', 'description' => 'Kerupuk gurih dan renyah dari kulit sapi pilihan.', 'net_weight' => 200, 'serving_size' => '20 gram (5 potong kecil)', 'ingredients' => [
                ['name' => 'Kulit Sapi', 'quantity' => 150],
                ['name' => 'Garam', 'quantity' => 10],
                ['name' => 'Minyak Goreng', 'quantity' => 40],
            ]],
            ['name' => 'Dendeng Sapi Manis', 'description' => 'Daging sapi iris tipis dimasak dengan bumbu kecap dan gula merah.', 'net_weight' => 150, 'serving_size' => '25 gram (3 potong)', 'ingredients' => [
                ['name' => 'Daging Sapi', 'quantity' => 100],
                ['name' => 'Kecap Manis', 'quantity' => 20],
                ['name' => 'Gula Merah', 'quantity' => 15],
                ['name' => 'Bawang Putih', 'quantity' => 10],
                ['name' => 'Garam', 'quantity' => 5],
            ]],
            ['name' => 'Abon Ayam Pedas', 'description' => 'Abon ayam pedas gurih dengan tekstur halus dan kering.', 'net_weight' => 100, 'serving_size' => '15 gram (1 sendok makan)', 'ingredients' => [
                ['name' => 'Daging Ayam Suwir', 'quantity' => 70],
                ['name' => 'Cabai Merah', 'quantity' => 10],
                ['name' => 'Bawang Merah', 'quantity' => 10],
                ['name' => 'Minyak Goreng', 'quantity' => 10],
            ]],
            ['name' => 'Mie Kering Sayur', 'description' => 'Mie kering buatan tangan dari tepung terigu dan ekstrak sayur.', 'net_weight' => 300, 'serving_size' => '75 gram (1 porsi)', 'ingredients' => [
                ['name' => 'Tepung Terigu', 'quantity' => 200],
                ['name' => 'Ekstrak Bayam', 'quantity' => 50],
                ['name' => 'Ekstrak Wortel', 'quantity' => 30],
                ['name' => 'Telur Ayam', 'quantity' => 20],
            ]],
        ];

        foreach ($products as $data) {
            $product = Product::create([
                'user_id' => 4,
                'name' => $data['name'],
                'description' => $data['description'],
                'net_weight' => $data['net_weight'],
                'serving_size' => $data['serving_size'],
                'status' => 'draft',
            ]);

            foreach ($data['ingredients'] as $ing) {
                $ingredient = Ingredient::firstOrCreate(['name' => $ing['name']], ['default_measure' => 'g']);

                ProductIngredient::create([
                    'product_id' => $product->id,
                    'ingredient_id' => $ingredient->id,
                    'quantity_g' => $ing['quantity'],
                ]);

                // Tambah data gizi (default kalau belum ada)
                $nutr = $nutritionDefaults[$ing['name']] ?? [
                    'per_100g_energy_kcal' => 100,
                    'per_100g_protein_g' => 2,
                    'per_100g_fat_g' => 2,
                    'per_100g_carbs_g' => 15,
                    'per_100g_sugar_g' => 3,
                    'sodium_mg' => 10,
                ];

                IngredientNutrition::firstOrCreate(
                    ['ingredient_id' => $ingredient->id],
                    $nutr
                );
            }
        }

        echo "✅ 10 Produk + IngredientNutrition berhasil dibuat (user_id=4)\n";
    }
}
