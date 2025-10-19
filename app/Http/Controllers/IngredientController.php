<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngredientNutrition;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IngredientsImport;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::with('nutrition')->orderBy('name')->get();
        return view('admin.ingredients.index', compact('ingredients'));
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
}
