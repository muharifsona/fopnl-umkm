@extends('layouts.public')

@section('content')

@php
    function getLightColor($label, $value) {
        if ($label === 'Gula') return $value <= 5 ? '#22c55e' : ($value <= 10 ? '#eab308' : '#ef4444');
        if ($label === 'Lemak') return $value <= 3 ? '#22c55e' : ($value <= 17 ? '#eab308' : '#ef4444');
        if ($label === 'Natrium') return $value <= 120 ? '#22c55e' : ($value <= 600 ? '#eab308' : '#ef4444');
        return '#9ca3af';
    }
@endphp

<div class="container mx-auto py-0">
    <h1 class="text-2xl font-bold mb-4">Produk UMKM</h1>
    @if($products->count())
        <div class="grid grid-cols-3 md:grid-cols-3 gap-4">
            @foreach($products as $product)

                <a href="{{ route('public.products.show', $product->id) }}"
                   class="block border rounded-lg bg-white shadow hover:shadow-lg transition p-3">
                    {{-- <h2 class="font-semibold text-lg">{{ $product->name }}</h2> --}}
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500">
                            <span class="font-medium">UMKM:</span> {{ $product->user->name ?? '-' }}
                        </p>
                    </div>
                    <p class="text-sm text-gray-600">{{ Str::limit($product->description, 70) }}</p>
                    <div class="mt-2 text-xs text-gray-500">
                        Berat bersih: {{ $product->net_weight }} g
                    </div>

                    {{-- ✅ Traffic Light FOPNL --}}
                    @if($product->nutritionSummary)
                        @php
                            $summary = $product->nutritionSummary;
                            $lights = [
                                ['label' => 'Gula', 'value' => $summary->per_serving_sugar_g, 'unit' => 'g'],
                                ['label' => 'Lemak', 'value' => $summary->per_serving_fat_g, 'unit' => 'g'],
                                ['label' => 'Natrium', 'value' => $summary->per_serving_sodium_mg, 'unit' => 'mg']
                            ];

                            // 🔹 Skor negatif (semakin besar = kurang sehat)
                            $neg = 0;
                            $neg += (($summary->per_serving_energy_kcal ?? 0) > 335) ? 2 : (($summary->per_serving_energy_kcal ?? 0) > 670 ? 4 : 0);
                            $neg += (($summary->per_serving_sugar_g ?? 0) > 10) ? 2 : (($summary->per_serving_sugar_g ?? 0) > 22.5 ? 4 : 0);
                            $neg += (($summary->per_serving_fat_g ?? 0) > 3) ? 2 : (($summary->per_serving_fat_g ?? 0) > 17.5 ? 4 : 0);
                            $neg += (($summary->per_serving_sodium_mg ?? 0) > 300) ? 2 : (($summary->per_serving_sodium_mg ?? 0) > 600 ? 4 : 0);

                            // 🔹 Skor positif (semakin besar = lebih sehat)
                            $pos = 0;
                            $pos += (($summary->per_serving_protein_g ?? 0) > 5) ? 2 : (($summary->per_serving_protein_g ?? 0) > 10 ? 4 : 0);

                            $score = $neg - $pos;

                            // 🔹 Konversi ke Nutri-Score
                            if ($score <= 0) { $nutriScore = 'A'; $nutriColor = '#00A300'; }
                            else if ($score <= 3) { $nutriScore = 'B'; $nutriColor = '#7CCD00'; }
                            else if ($score <= 10) { $nutriScore = 'C'; $nutriColor = '#FFD700'; }
                            else if ($score <= 18) { $nutriScore = 'D'; $nutriColor = '#FF8C00'; }
                            else if ($score > 18) { $nutriScore = 'E'; $nutriColor = '#FF0000'; }

                        @endphp

                        <div style="text-align: left; margin-top: 10px;">
                            <div style="display: inline-block; background-color: {{ $nutriColor }}; color: white; padding: 10px 15px; border-radius: 8px; font-weight: bold; font-size: 12px;">
                                Nutri-Score: {{ $nutriScore }}
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-0 justify-items-center mt-4" style="width: 70%">
                            @foreach($lights as $light)
                                @php $color = getLightColor($light['label'], $light['value']); @endphp
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 rounded-full flex items-center justify-center text-white text-center font-bold text-lg shadow-lg"
                                            style="background-color: {{ $color }}">
                                        {{-- {{ $light['value'] }}<br>{{ $light['unit'] }} --}}
                                        {{ $light['label'] }}
                                    </div>
                                    {{-- <span class="text-sm mt-2 font-semibold text-gray-800">{{ $light['label'] }}</span> --}}
                                </div>
                            @endforeach

                        </div>
                    @endif
                </a>

            @endforeach
        </div>

        <div class="mt-6">{{ $products->links() }}</div>
    @else
        <p class="text-gray-500">Belum ada produk yang tersedia.</p>
    @endif
</div>
@endsection
