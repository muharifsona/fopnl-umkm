<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIngredient;
use App\Models\Ingredient;
use App\Services\NutritionCalculator;
use App\Helpers\AuditHelper;
use Illuminate\Http\Request;

class ProductIngredientController extends Controller
{
    public function index(Product $product)
    {
        $this->authorize('update', $product);

        // ambil semua ingredient dari database untuk dropdown
        $ingredients = Ingredient::orderBy('name')->get();

        // ambil semua bahan produk ini
        $productIngredients = $product->productIngredients()->with('ingredient')->get();

        // kirim semua data ke view
        return view('product_ingredients.index', compact('product', 'ingredients', 'productIngredients'));
    }

    public function store(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity_g'    => 'required|numeric|min:0.1',
            'notes'         => 'nullable|string|max:255',
        ]);

        $ingredient = Ingredient::find($validated['ingredient_id']);

        $productIngredient = ProductIngredient::create([
            'product_id'    => $product->id,
            'ingredient_id' => $validated['ingredient_id'],
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
