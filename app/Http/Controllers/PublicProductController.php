<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\NutriScoreHelper;

class PublicProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['user', 'nutritionSummary'])
            ->where('status', 'approved')
            ->latest()
            ->paginate(12);
            // ->get();

        return view('public.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['productIngredients.ingredient', 'nutritionSummary']);
        $summary = $product->nutritionSummary;

        // 🔹 Hitung Nutri-Score
        $nutriScore = NutriScoreHelper::calculate(
            $summary->per_serving_energy_kcal ?? 0,
            $summary->per_serving_sugar_g ?? 0,
            $summary->per_serving_fat_g ?? 0,
            $summary->per_serving_sodium_mg ?? 0,
            $summary->per_serving_protein_g ?? 0
        );
        $nutriColor = NutriScoreHelper::color($nutriScore);

        if ($product->status !== 'approved') {
            abort(404);
        }

        $product->load([
            'productIngredients.ingredient',
            'nutritionSummary'
        ]);

        return view('public.products.show', compact('product', 'summary', 'nutriScore', 'nutriColor'));
    }
}
