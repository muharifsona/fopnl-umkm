<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIngredient;
use App\Models\Ingredient;
use App\Services\NutritionCalculator;
use App\Helpers\AuditHelper;
use App\Services\FatSecretService;
use Illuminate\Http\Request;

class ProductIngredientController extends Controller
{
    public function index(Request $request, Product $product, FatSecretService $fatSecret)
    {
        $this->authorize('update', $product);

        // ambil semua ingredient dari database untuk dropdown
        $ingredients = Ingredient::orderBy('name')->get();

        // ambil semua bahan produk ini
        $productIngredients = $product->productIngredients()->with('ingredient')->get();

        // Fitur Pencarian FatSecret
        $searchQuery = $request->input('search');
        $apiIngredients = [];

        if ($searchQuery) {
            $searchResults = $fatSecret->searchIngredients($searchQuery);

            // Batasi pencarian 5 teratas agar server tidak loading terlalu lama,
            // karena kita harus mengecek rincian gizi satu per satu ke API.
            $searchResults = array_slice($searchResults, 0, 5);

            foreach ($searchResults as $food) {
                $details = $fatSecret->getFoodDetails($food['food_id']);
                if ($details && isset($details['servings']['serving'])) {
                    $servings = $details['servings']['serving'];
                    $servings = isset($servings[0]) ? $servings : [$servings];

                    $targetServing = null;
                    foreach ($servings as $s) {
                        $is100g = (($s['metric_serving_amount'] ?? '') == '100.000' ||
                                   strpos(strtolower($s['serving_description'] ?? ''), '100 g') !== false ||
                                   strpos(strtolower($s['serving_description'] ?? ''), '100 ml') !== false);
                        if ($is100g) {
                            $targetServing = $s;
                            break;
                        }
                    }

                    if ($targetServing) {
                        // FILTER KETAT: Pastikan ke-7 parameter gizi wajib tersedia di sistem FatSecret
                        $hasAll = isset($targetServing['calories'], $targetServing['protein'], $targetServing['fat'],
                                        $targetServing['saturated_fat'], $targetServing['carbohydrate'],
                                        $targetServing['sugar'], $targetServing['sodium']);

                        if ($hasAll) {
                            $food['detailed_nutrition'] = $targetServing;
                            $apiIngredients[] = $food;
                        }
                    }
                }
            }
        }

        // kirim semua data ke view
        return view('product_ingredients.index', compact('product', 'ingredients', 'productIngredients', 'apiIngredients', 'searchQuery'));
    }

    public function store(Request $request, Product $product, FatSecretService $fatSecret)
    {
        $this->authorize('update', $product);

        if ($request->has('fatsecret_id')) {
            // JIKA UMKM MEMILIH DARI FATSECRET
            $validated = $request->validate([
                'fatsecret_id'  => 'required',
                'name'          => 'required|string|max:255',
                'quantity_g'    => 'required|numeric|min:0.1',
                'notes'         => 'nullable|string|max:255',
            ]);

            // Ambil rincian dari API lagi untuk memastikan
            $details = $fatSecret->getFoodDetails($request->fatsecret_id);
            if (!$details || !isset($details['servings']['serving'])) {
                return back()->with('error', 'Gagal mengambil detail dari FatSecret API.');
            }

            $servings = $details['servings']['serving'];
            $servings = isset($servings[0]) ? $servings : [$servings];

            $targetServing = null;
            foreach ($servings as $s) {
                $is100g = (($s['metric_serving_amount'] ?? '') == '100.000' ||
                           strpos(strtolower($s['serving_description'] ?? ''), '100 g') !== false ||
                           strpos(strtolower($s['serving_description'] ?? ''), '100 ml') !== false);
                if ($is100g) { $targetServing = $s; break; }
            }

            if (!$targetServing) return back()->with('error', 'Bahan tidak memenuhi standar 100g.');

            // 1. Simpan otomatis ke database sebagai bahan lokal baru
            $ingredient = Ingredient::firstOrCreate(
                ['name' => $request->name],
                ['default_measure' => 'g', 'notes' => 'Diimpor oleh UMKM dari API FatSecret (ID: ' . $request->fatsecret_id . ').']
            );

            // 2. Simpan nilai nutrisi lengkapnya
            \App\Models\IngredientNutrition::firstOrCreate(
                ['ingredient_id' => $ingredient->id],
                [
                    'per_100g_energy_kcal'     => (float) ($targetServing['calories'] ?? 0),
                    'per_100g_protein_g'       => (float) ($targetServing['protein'] ?? 0),
                    'per_100g_fat_g'           => (float) ($targetServing['fat'] ?? 0),
                    'per_100g_saturated_fat_g' => (float) ($targetServing['saturated_fat'] ?? 0),
                    'per_100g_carbs_g'         => (float) ($targetServing['carbohydrate'] ?? 0),
                    'per_100g_sugar_g'         => (float) ($targetServing['sugar'] ?? 0),
                    'sodium_mg'                => (float) ($targetServing['sodium'] ?? 0),
                ]
            );

            $ingredientId = $ingredient->id;
        } else {
            // JIKA UMKM MEMILIH DARI DATABASE LOKAL (DROPDOWN BIASA)
            $validated = $request->validate([
                'ingredient_id' => 'required|exists:ingredients,id',
                'quantity_g'    => 'required|numeric|min:0.1',
                'notes'         => 'nullable|string|max:255',
            ]);
            $ingredientId = $validated['ingredient_id'];
        }

        $ingredient = Ingredient::find($ingredientId);

        $productIngredient = ProductIngredient::create([
            'product_id'    => $product->id,
            'ingredient_id' => $ingredientId,
            'quantity_g'    => $validated['quantity_g'],
            'notes'         => $validated['notes'] ?? null,
        ]);

        // 🔹 Hitung ulang total gizi
        NutritionCalculator::calculate($product);

        // 🔹 Catat ke audit log
        AuditHelper::log(
            'product_ingredients',           // entity
            $productIngredient->id,          // entity_id
            'create',                        // action
            sprintf(
                'Menambahkan bahan "%s" (%.1f g) ke produk "%s"',
                $ingredient->name,
                $validated['quantity_g'],
                $product->name
            )
        );

        return redirect()
            ->back()
            ->with('success', 'Bahan ditambahkan dan nilai gizi diperbarui.');
    }

    public function update(Request $request, ProductIngredient $ingredient)
    {
        $this->authorize('update', $ingredient->product);

        $validated = $request->validate([
            'quantity_g' => 'required|numeric|min:0.1',
            'notes'      => 'nullable|string|max:255',
        ]);

        // 🔹 Simpan data lama untuk perbandingan di log
        $oldQuantity = $ingredient->quantity_g;
        $oldNotes = $ingredient->notes;

        // 🔹 Update data
        $ingredient->update([
            'quantity_g' => $validated['quantity_g'],
            'notes'      => $validated['notes'],
        ]);

        // 🔹 Hitung ulang total gizi produk
        NutritionCalculator::calculate($ingredient->product);

        // 🔹 Siapkan detail perubahan untuk log
        $details = sprintf(
            'Memperbarui bahan "%s" pada produk "%s": quantity %.1f → %.1f g%s',
            $ingredient->ingredient->name,
            $ingredient->product->name,
            $oldQuantity,
            $validated['quantity_g'],
            $oldNotes !== $validated['notes']
                ? ', notes diubah'
                : ''
        );

        // 🔹 Catat ke Audit Log
        AuditHelper::log(
            'product_ingredients',
            $ingredient->id,
            'update',
            $details
        );

        return redirect()
            ->back()
            ->with('success', 'Data bahan diperbarui dan nilai gizi dihitung ulang.');
    }

    public function destroy(Product $product, ProductIngredient $productIngredient)
    {
        // Pastikan productIngredient memang milik product ini
        if ($productIngredient->product_id !== $product->id) {
            abort(403, 'Bahan tidak termasuk dalam produk ini.');
        }

        if ($product->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan menghapus produk ini');
        }

        // 🔹 Simpan data sebelum dihapus (untuk log)
        $ingredientName = $productIngredient->ingredient->name ?? 'Tidak diketahui';
        $quantity = $productIngredient->quantity_g ?? 0;

        // 🔹 Hapus data bahan
        $productIngredient->delete();

        // 🔹 Hitung ulang gizi produk
        NutritionCalculator::calculate($product);

        // 🔹 Catat ke audit log
        AuditHelper::log(
            'product_ingredients',                     // entity
            $productIngredient->id,                    // entity_id
            'delete',                                  // action
            sprintf(
                'Menghapus bahan "%s" (%.1f g) dari produk "%s"',
                $ingredientName,
                $quantity,
                $product->name
            )
        );

        return redirect()
            ->back()
            ->with('success', 'Bahan dihapus dan nilai gizi diperbarui.');
    }

}
