@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-xl p-6 max-w-12xl mx-auto">
        {{-- ✅ Header Produk --}}
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                {{-- ✅ Nama UMKM --}}
                @if($product->user)
                    <p class="text-sm text-gray-500 mt-1">
                        <span class="font-semibold">UMKM:</span> {{ $product->user->name }}
                    </p>
                @endif

                <p class="text-gray-600 text-sm mt-2">{{ $product->description }}</p>
                <p class="text-gray-500 text-xs mt-2">Berat bersih: {{ number_format($product->net_weight, 0) }} g</p>
                <p class="text-gray-500 text-xs">Takaran saji: {{ $product->serving_size }}</p>
            </div>
            <div>
                <img src="data:image/svg+xml;base64,{{ base64_encode((new BaconQrCode\Writer(
                    new BaconQrCode\Renderer\ImageRenderer(
                        new BaconQrCode\Renderer\RendererStyle\RendererStyle(100),
                        new BaconQrCode\Renderer\Image\SvgImageBackEnd()
                    )))->writeString(url('/products/' . $product->id))) }}"
                    alt="QR Code" class="w-20 h-20">
            </div>
        </div>

        <div style="text-align: left; margin-top: 10px; margin-bottom: 10px;">
            <div style="display: inline-block; background-color: {{ $nutriColor }}; color: white; padding: 10px 15px; border-radius: 8px; font-weight: bold; font-size: 12px;">
                Nutri-Score: {{ $nutriScore }}
            </div>
        </div>

        <hr class="my-6">

        {{-- ✅ Traffic Light FOPNL --}}
        @if($product->nutritionSummary)
            @php
                $summary = $product->nutritionSummary;
                $lights = [
                    ['label' => 'Energi', 'value' => $summary->per_serving_energy_kcal, 'unit' => 'kkal'],
                    ['label' => 'Gula', 'value' => $summary->per_serving_sugar_g, 'unit' => 'g'],
                    ['label' => 'Lemak', 'value' => $summary->per_serving_fat_g, 'unit' => 'g'],
                    ['label' => 'Lemak Jenuh', 'value' => $summary->per_serving_saturated_fat_g, 'unit' => 'g'],
                    ['label' => 'Natrium', 'value' => $summary->per_serving_sodium_mg, 'unit' => 'mg']
                ];

                function getLightColor($label, $value) {
                    if ($label === 'Energi') return $value <= 5 ? '#3B82F6' : ($value <= 10 ? '#3B82F6' : '#3B82F6');
                    if ($label === 'Gula') return $value <= 5 ? '#22c55e' : ($value <= 10 ? '#eab308' : '#ef4444');
                    if ($label === 'Lemak') return $value <= 3 ? '#22c55e' : ($value <= 17 ? '#eab308' : '#ef4444');
                    if ($label === 'Lemak Jenuh') return $value <= 3 ? '#22c55e' : ($value <= 17 ? '#eab308' : '#ef4444');
                    if ($label === 'Natrium') return $value <= 120 ? '#22c55e' : ($value <= 600 ? '#eab308' : '#ef4444');
                    return '#9ca3af';
                }
            @endphp

            <div class="grid grid-cols-3 gap-6 justify-items-center mt-4">
                @foreach($lights as $light)
                    @php $color = getLightColor($light['label'], $light['value']); @endphp
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center text-white font-bold text-lg shadow"
                             style="background-color: {{ $color }}; padding: 5px">
                            <small>{{ $light['value'] }}{{ $light['unit'] }}</small>
                        </div>
                        <span class="text-sm mt-2 font-semibold text-gray-800">{{ $light['label'] }}</span>
                    </div>
                @endforeach
            </div>

            <hr class="my-6" style="margin-top: 10px">

        @endif

        <hr class="my-6">

        {{-- ✅ Informasi Nilai Gizi --}}
        @if($product->nutritionSummary)
            <div>
                <h3 class="text-lg font-bold mb-3 text-gray-800">Informasi Nilai Gizi (per sajian)</h3>
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b"><td class="p-2">Energi Total</td><td class="p-2 text-right">{{ $summary->per_serving_energy_kcal }} kkal</td></tr>
                            <tr class="border-b"><td class="p-2">Protein</td><td class="p-2 text-right">{{ $summary->per_serving_protein_g }} g</td></tr>
                            <tr class="border-b"><td class="p-2">Lemak Total</td><td class="p-2 text-right">{{ $summary->per_serving_fat_g }} g</td></tr>
                            <tr class="border-b"><td class="p-2">Lemak Jenuh Total</td><td class="p-2 text-right">{{ $summary->per_serving_saturated_fat_g }} g</td></tr>
                            <tr class="border-b"><td class="p-2">Karbohidrat</td><td class="p-2 text-right">{{ $summary->per_serving_carbs_g }} g</td></tr>
                            <tr class="border-b"><td class="p-2">Gula</td><td class="p-2 text-right">{{ $summary->per_serving_sugar_g }} g</td></tr>
                            <tr><td class="p-2">Natrium</td><td class="p-2 text-right">{{ $summary->per_serving_sodium_mg }} mg</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <hr class="my-6">

        {{-- ✅ Daftar Komposisi --}}
        <div>
            <h3 class="text-lg font-bold mb-3 text-gray-800">Komposisi:</h3>
            @if($product->productIngredients && $product->productIngredients->count())
                <ul class="list-disc list-inside text-gray-700">
                    @foreach($product->productIngredients as $pi)
                        <li>{{ $pi->ingredient->name }} ({{ number_format($pi->quantity_g, 1) }} g)</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 text-sm">Belum ada data komposisi bahan.</p>
            @endif
        </div>

        <div class="text-center mt-10 text-xs text-gray-400">
            Data produk ini diambil dari sistem FOPNL UMKM.<br>
            <span class="italic">Terakhir diperbarui: {{ $product->updated_at->format('d M Y') }}</span>
        </div>
    </div>
</div>
@endsection
