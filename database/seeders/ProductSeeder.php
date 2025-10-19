<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\ProductIngredient;

class Product1Seeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // 1️⃣ Keripik Bayam Crispy
        // =========================
        $bayam = Product::create([
            'user_id' => 4,
            'name' => 'Keripik Bayam Crispy',
            'description' => 'Cemilan renyah dari daun bayam pilihan dengan balutan tepung gurih.',
            'net_weight' => 100,
            'serving_size' => '20 gram (±5 lembar)',
            'status' => 'draft',
        ]);

        $bayamIngredients = [
            ['name' => 'Daun Bayam', 'quantity' => 50],
            ['name' => 'Tepung Terigu', 'quantity' => 30],
            ['name' => 'Tepung Beras', 'quantity' => 10],
            ['name' => 'Bawang Putih', 'quantity' => 5],
            ['name' => 'Minyak Goreng', 'quantity' => 5],
        ];

        foreach ($bayamIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $bayam->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 2️⃣ Tahu Walik Pedas
        // =========================
        $tahu = Product::create([
            'user_id' => 4,
            'name' => 'Tahu Walik Pedas',
            'description' => 'Tahu goreng terbalik khas Banyuwangi dengan isian ayam dan cabai.',
            'net_weight' => 150,
            'serving_size' => '30 gram (2 potong)',
            'status' => 'draft',
        ]);

        $tahuIngredients = [
            ['name' => 'Tahu Putih', 'quantity' => 100],
            ['name' => 'Daging Ayam Cincang', 'quantity' => 30],
            ['name' => 'Cabai Merah', 'quantity' => 10],
            ['name' => 'Bawang Putih', 'quantity' => 5],
            ['name' => 'Minyak Goreng', 'quantity' => 5],
        ];

        foreach ($tahuIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $tahu->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 3️⃣ Es Kopi Gula Aren Botol
        // =========================
        $kopi = Product::create([
            'user_id' => 4,
            'name' => 'Es Kopi Gula Aren Botol',
            'description' => 'Minuman kopi susu dingin dengan campuran gula aren asli.',
            'net_weight' => 250,
            'serving_size' => '250 ml (1 botol)',
            'status' => 'draft',
        ]);

        $kopiIngredients = [
            ['name' => 'Kopi Bubuk Robusta', 'quantity' => 15],
            ['name' => 'Susu Cair', 'quantity' => 200],
            ['name' => 'Gula Aren Cair', 'quantity' => 30],
            ['name' => 'Air', 'quantity' => 5],
        ];

        foreach ($kopiIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $kopi->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 4️⃣ Tempe Orek Kering
        // =========================
        $orek = Product::create([
            'user_id' => 4,
            'name' => 'Tempe Orek Kering',
            'description' => 'Tempe goreng kering manis gurih dengan bumbu kecap dan cabai.',
            'net_weight' => 180,
            'serving_size' => '30 gram (3 sendok makan)',
            'status' => 'draft',
        ]);

        $orekIngredients = [
            ['name' => 'Tempe', 'quantity' => 100],
            ['name' => 'Kecap Manis', 'quantity' => 20],
            ['name' => 'Cabai Merah', 'quantity' => 10],
            ['name' => 'Bawang Merah', 'quantity' => 10],
            ['name' => 'Gula Merah', 'quantity' => 10],
            ['name' => 'Minyak Goreng', 'quantity' => 10],
        ];

        foreach ($orekIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $orek->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 5️⃣ Keripik Jagung Pedas Manis
        // =========================
        $jagung = Product::create([
            'user_id' => 4,
            'name' => 'Keripik Jagung Pedas Manis',
            'description' => 'Cemilan jagung goreng gurih dengan bumbu balado manis pedas.',
            'net_weight' => 120,
            'serving_size' => '25 gram (1 genggam kecil)',
            'status' => 'draft',
        ]);

        $jagungIngredients = [
            ['name' => 'Jagung Pipil', 'quantity' => 80],
            ['name' => 'Tepung Beras', 'quantity' => 20],
            ['name' => 'Gula Pasir', 'quantity' => 10],
            ['name' => 'Cabai Bubuk', 'quantity' => 5],
            ['name' => 'Minyak Goreng', 'quantity' => 5],
        ];

        foreach ($jagungIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $jagung->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 6️⃣ Roti Gandum Isi Cokelat
        // =========================
        $roti = Product::create([
            'user_id' => 4,
            'name' => 'Roti Gandum Isi Cokelat',
            'description' => 'Roti lembut dari tepung gandum dengan isian cokelat pekat.',
            'net_weight' => 250,
            'serving_size' => '1 potong (50 gram)',
            'status' => 'draft',
        ]);

        $rotiIngredients = [
            ['name' => 'Tepung Gandum', 'quantity' => 100],
            ['name' => 'Cokelat Pasta', 'quantity' => 30],
            ['name' => 'Gula Pasir', 'quantity' => 20],
            ['name' => 'Ragi Instan', 'quantity' => 5],
            ['name' => 'Mentega', 'quantity' => 10],
            ['name' => 'Susu Bubuk', 'quantity' => 10],
        ];

        foreach ($rotiIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $roti->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 7️⃣ Kerupuk Kulit Sapi
        // =========================
        $kulit = Product::create([
            'user_id' => 4,
            'name' => 'Kerupuk Kulit Sapi',
            'description' => 'Kerupuk gurih dan renyah dari kulit sapi pilihan, digoreng kering.',
            'net_weight' => 200,
            'serving_size' => '20 gram (5 potong kecil)',
            'status' => 'draft',
        ]);

        $kulitIngredients = [
            ['name' => 'Kulit Sapi', 'quantity' => 150],
            ['name' => 'Garam', 'quantity' => 10],
            ['name' => 'Minyak Goreng', 'quantity' => 40],
        ];

        foreach ($kulitIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $kulit->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 8️⃣ Dendeng Sapi Manis
        // =========================
        $dendeng = Product::create([
            'user_id' => 4,
            'name' => 'Dendeng Sapi Manis',
            'description' => 'Daging sapi iris tipis dimasak dengan bumbu kecap dan gula merah.',
            'net_weight' => 150,
            'serving_size' => '25 gram (3 potong)',
            'status' => 'draft',
        ]);

        $dendengIngredients = [
            ['name' => 'Daging Sapi', 'quantity' => 100],
            ['name' => 'Kecap Manis', 'quantity' => 20],
            ['name' => 'Gula Merah', 'quantity' => 15],
            ['name' => 'Bawang Putih', 'quantity' => 10],
            ['name' => 'Garam', 'quantity' => 5],
        ];

        foreach ($dendengIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $dendeng->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 9️⃣ Abon Ayam Pedas
        // =========================
        $abon = Product::create([
            'user_id' => 4,
            'name' => 'Abon Ayam Pedas',
            'description' => 'Abon ayam pedas gurih dengan tekstur halus dan kering.',
            'net_weight' => 100,
            'serving_size' => '15 gram (1 sendok makan)',
            'status' => 'draft',
        ]);

        $abonIngredients = [
            ['name' => 'Daging Ayam Suwir', 'quantity' => 70],
            ['name' => 'Cabai Merah', 'quantity' => 10],
            ['name' => 'Bawang Merah', 'quantity' => 10],
            ['name' => 'Gula Merah', 'quantity' => 5],
            ['name' => 'Minyak Goreng', 'quantity' => 5],
        ];

        foreach ($abonIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $abon->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        // =========================
        // 🔟 Mie Kering Sayur
        // =========================
        $mie = Product::create([
            'user_id' => 4,
            'name' => 'Mie Kering Sayur',
            'description' => 'Mie kering buatan tangan dari tepung terigu dan ekstrak bayam wortel.',
            'net_weight' => 300,
            'serving_size' => '75 gram (1 porsi)',
            'status' => 'draft',
        ]);

        $mieIngredients = [
            ['name' => 'Tepung Terigu', 'quantity' => 200],
            ['name' => 'Ekstrak Bayam', 'quantity' => 50],
            ['name' => 'Ekstrak Wortel', 'quantity' => 30],
            ['name' => 'Telur Ayam', 'quantity' => 20],
        ];

        foreach ($mieIngredients as $data) {
            $ingredient = Ingredient::firstOrCreate(['name' => $data['name']], ['default_measure' => 'g']);
            ProductIngredient::create([
                'product_id' => $mie->id,
                'ingredient_id' => $ingredient->id,
                'quantity_g' => $data['quantity'],
            ]);
        }

        echo "✅ 10 produk baru (user_id=4) berhasil dibuat dengan format yang sama.\n";
    }
}
