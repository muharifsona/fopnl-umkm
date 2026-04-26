<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngredientNutrition;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IngredientsImport;
use App\Services\FatSecretService;

class IngredientController extends Controller
{
    public function index(Request $request, FatSecretService $fatSecret)
    {
        $searchQuery = $request->input('search');

        // 1. Ambil data dari Database Lokal
        $ingredientsQuery = Ingredient::with('nutrition')->orderBy('name');
        if ($searchQuery) {
            $ingredientsQuery->where('name', 'like', "%{$searchQuery}%");
        }
        $ingredients = $ingredientsQuery->get();

        // 2. Ambil data dari FatSecret API (Hanya dieksekusi jika ada pencarian)
        $apiIngredients = [];
        if ($searchQuery) {
            $apiIngredients = $fatSecret->searchIngredients($searchQuery);
        }

        return view('admin.ingredients.index', compact('ingredients', 'apiIngredients', 'searchQuery'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new IngredientsImport, $request->file('file'));

        return back()->with('success', 'Data bahan dan nilai gizi berhasil diimpor!');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'default_measure' => 'required|string|max:10',
        ]);

        $ingredient = Ingredient::create($r->only('name', 'default_measure', 'notes'));

        IngredientNutrition::create([
            'ingredient_id' => $ingredient->id,
            'per_100g_energy_kcal' => 0,
            'per_100g_protein_g' => 0,
            'per_100g_fat_g' => 0,
            'per_100g_saturated_fat_g' => 0,
            'per_100g_carbs_g' => 0,
            'per_100g_sugar_g' => 0,
            'sodium_mg' => 0,
        ]);

        return back()->with('success', 'Bahan baru berhasil ditambahkan.');
    }

    public function update(Request $r, Ingredient $ingredient)
    {
        $ingredient->update($r->only('name', 'default_measure', 'notes'));

        $ingredient->nutrition()->update([
            'per_100g_energy_kcal' => $r->per_100g_energy_kcal,
            'per_100g_protein_g' => $r->per_100g_protein_g,
            'per_100g_fat_g' => $r->per_100g_fat_g,
            'per_100g_saturated_fat_g' => $r->per_100g_saturated_fat_g,
            'per_100g_carbs_g' => $r->per_100g_carbs_g,
            'per_100g_sugar_g' => $r->per_100g_sugar_g,
            'sodium_mg' => $r->sodium_mg,
        ]);

        return back()->with('success', 'Data bahan berhasil diperbarui.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return back()->with('success', 'Bahan dihapus.');
    }

    // Method untuk menyimpan bahan dari FatSecret ke DB Lokal
    public function importFatSecret(Request $request, FatSecretService $fatSecret)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fatsecret_id' => 'required',
            'food_description' => 'nullable|string'
        ]);

        // Ambil detail nutrisi lengkap dari FatSecret
        $foodDetails = $fatSecret->getFoodDetails($request->fatsecret_id);

        $energy = 0; $protein = 0; $fat = 0; $carbs = 0;
        $saturated_fat = 0; $sugar = 0; $sodium = 0;
        $servingSize = '100g';
        $is100g = false;

        // Jika berhasil mendapatkan data detail
        if ($foodDetails && isset($foodDetails['servings']['serving'])) {
            $servings = $foodDetails['servings']['serving'];

            // Fatsecret mengembalikan array multi-dimensi jika ada banyak pilihan porsi
            $targetServing = isset($servings[0]) ? $servings[0] : $servings;

            // Utamakan mencari takaran 100g otomatis jika tersedia
            if (isset($servings[0])) {
                foreach ($servings as $s) {
                    if (($s['metric_serving_amount'] ?? '') == '100.000' || strpos(strtolower($s['serving_description'] ?? ''), '100 g') !== false) {
                        $targetServing = $s;
                        break;
                    }
                }
            }

            $energy = (float) ($targetServing['calories'] ?? 0);
            $protein = (float) ($targetServing['protein'] ?? 0);
            $fat = (float) ($targetServing['fat'] ?? 0);
            $carbs = (float) ($targetServing['carbohydrate'] ?? 0);
            $saturated_fat = (float) ($targetServing['saturated_fat'] ?? 0);
            $sugar = (float) ($targetServing['sugar'] ?? 0);
            $sodium = (float) ($targetServing['sodium'] ?? 0);

            $metricAmount = $targetServing['metric_serving_amount'] ?? '';
            $metricUnit = $targetServing['metric_serving_unit'] ?? '';

            if ($metricAmount && $metricUnit) {
                $servingSize = (float)$metricAmount . $metricUnit;
                $is100g = ((float)$metricAmount == 100 && strtolower($metricUnit) == 'g');
            } else {
                $servingSize = $targetServing['serving_description'] ?? '1 portion';
                $is100g = in_array(strtolower(str_replace(' ', '', $servingSize)), ['100g', '100ml']);
            }
        } else {
            // FALLBACK: Ekstrak dari string deskripsi jika getFoodDetails gagal
            $description = $request->food_description ?? '';
            if (preg_match('/Per\s+([^-]+)\s*-/i', $description, $matches)) $servingSize = trim($matches[1]);
            if (preg_match('/Calories:\s*([\d\.]+)\s*kcal/i', $description, $matches)) $energy = (float) $matches[1];
            if (preg_match('/Protein:\s*([\d\.]+)\s*g/i', $description, $matches)) $protein = (float) $matches[1];
            if (preg_match('/Fat:\s*([\d\.]+)\s*g/i', $description, $matches)) $fat = (float) $matches[1];
            if (preg_match('/Carbs:\s*([\d\.]+)\s*g/i', $description, $matches)) $carbs = (float) $matches[1];
            $is100g = in_array(strtolower(str_replace(' ', '', $servingSize)), ['100g', '100ml']);
        }

        $notes = 'Diimpor dari FatSecret (ID: ' . $request->fatsecret_id . '). Takaran asal: ' . $servingSize . '.';
        if (!$is100g) {
            $notes .= ' PERHATIAN: Nilai gizi belum dalam takaran 100g, harap sesuaikan manual.';
        }

        // Simpan data bahan ke tabel ingredients
        $ingredient = Ingredient::firstOrCreate(
            ['name' => $request->name],
            [
                'default_measure' => 'g',
                'notes' => $notes
            ]
        );

        // Simpan nilai gizi hasil ekstrak ke tabel ingredient_nutritions
        IngredientNutrition::firstOrCreate(
            ['ingredient_id' => $ingredient->id],
            [
                'per_100g_energy_kcal' => $energy,
                'per_100g_protein_g' => $protein,
                'per_100g_fat_g' => $fat,
                'per_100g_saturated_fat_g' => $saturated_fat,
                'per_100g_carbs_g' => $carbs,
                'per_100g_sugar_g' => $sugar,
                'sodium_mg' => $sodium,
            ]
        );

        // Pesan flash menyesuaikan
        $message = 'Bahan dari FatSecret berhasil ditambahkan ke database dengan rincian nilai gizi lengkap.';
        if (!$is100g) {
            $message = '⚠️ PERHATIAN: Bahan diimpor dengan takaran "' . $servingSize . '" (bukan 100g). Mohon sesuaikan angka gizinya menjadi per 100g secara manual!';
        }

        return back()->with('success', $message);
    }
}
