<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\NutriScoreHelper;
use PDF; // alias from barryvdh
use Carbon\Carbon;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;

class ProductLabelController extends Controller
{
    // Show label as HTML (print preview)
    public function show(Product $product)
    {
        // eager load nutrition summary
        $product->load(['productIngredients.ingredient', 'nutritionSummary']);
        // compute data for label if not present
        $summary = $product->nutritionSummary;
        if (!$summary) {
            \App\Services\NutritionCalculator::calculate($product);
            $product->refresh();
            $summary = $product->nutritionSummary;
        }

        // 🔹 Hitung Nutri-Score
        $nutriScore = NutriScoreHelper::calculate(
            $summary->per_serving_energy_kcal ?? 0,
            $summary->per_serving_sugar_g ?? 0,
            $summary->per_serving_fat_g ?? 0,
            $summary->per_serving_sodium_mg ?? 0,
            $summary->per_serving_protein_g ?? 0
        );
        $nutriColor = NutriScoreHelper::color($nutriScore);

        // ✅ Generate QR Code pakai SVG renderer (aman semua versi)
        $url = url('/products/' . $product->id);
        $renderer = new ImageRenderer(
            new RendererStyle(150),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCode = base64_encode($writer->writeString($url));

        return view('products.label', compact('product','summary','qrCode', 'nutriScore', 'nutriColor'));
    }

    // Generate PDF (stream or download)
    public function pdf(Product $product, Request $request)
    {
        // Muat relasi produk & ringkasan nutrisi
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

        // ✅ Generate QR Code pakai SVG renderer (aman semua versi)
        $url = url('/products/' . $product->id);
        $renderer = new ImageRenderer(
            new RendererStyle(150),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCode = base64_encode($writer->writeString($url));

        // ✅ Generate PDF dari view
        $pdf = Pdf::loadView('products.label', compact('product', 'summary', 'qrCode', 'nutriScore', 'nutriColor'))
                ->setPaper('a4', 'portrait');
        // Inline tampil di browser (bisa ubah ke download kalau mau)
        return $pdf->stream("label-{$product->id}.pdf");
    }
}
