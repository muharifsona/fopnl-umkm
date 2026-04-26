@extends('layouts.app')

@section('content')
<div class="max-w-12xl mx-auto mt-0 bg-white rounded-xl shadow-lg p-6 space-y-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
    <p class="text-gray-500 text-sm">Ringkasan Nilai Gizi (per 100g produk)</p>

    <!-- Grid Nilai Gizi -->
    <div class="grid grid-cols-2 gap-y-2 text-sm mt-4">
        <div>Energi</div> <div class="text-right font-medium">{{ number_format($nutrition['energy_kcal'], 1) }} kcal</div>
        <div>Protein</div> <div class="text-right font-medium">{{ number_format($nutrition['protein_g'], 1) }} g</div>
        <div>Lemak Total</div> <div class="text-right font-medium">{{ number_format($nutrition['fat_g'], 1) }} g</div>
        <div>Lemak Jenuh Total</div> <div class="text-right font-medium">{{ number_format($nutrition['saturated_fat_g'], 1) }} g</div>
        <div>Karbohidrat</div> <div class="text-right font-medium">{{ number_format($nutrition['carbs_g'], 1) }} g</div>
        <div>Gula Total</div> <div class="text-right font-medium">{{ number_format($nutrition['sugar_g'], 1) }} g</div>
        <div>Natrium</div> <div class="text-right font-medium">{{ number_format($nutrition['sodium_mg'], 1) }} mg</div>
    </div>

    <!-- FOPNL Traffic Light -->
    <div class="mt-6 text-center">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Indikator Gizi (FOPNL)</h3>
        <div class="flex justify-center gap-4">
            @foreach ($fopnl as $key => $val)
                <div class="flex flex-col items-center">
                    <div class="rounded-full w-16 h-16 flex items-center justify-center
                        {{ $val['color'] === 'red' ? 'bg-red-500 text-white' :
                           ($val['color'] === 'yellow' ? 'bg-yellow-400 text-white' :
                           ($val['color'] === 'green' ? 'bg-green-500 text-white' : 'bg-blue-400 text-white')) }}">
                        <small style="padding: 10px;">{{ ucfirst($val['label']) }}</small>
                    </div>
                    <span class="text-sm text-gray-600 mt-2 capitalize">{{ ucwords(str_replace("_", " ", $key)) }}</span>
                </div>
            @endforeach
        </div>
        <div style="text-align: center; margin-bottom: 10px;">
            <div style="display: inline-block; background-color: {{ $nutriColor }}; color: white; padding: 2px 5px; border-radius: 8px; font-weight: bold; font-size: 12px;">
                Nutri-Score: {{ $nutriScore }}
            </div>
        </div>

    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6 text-center">
        <a href="{{ route('products.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md">
           ← Kembali ke Produk
        </a> &nbsp;

        @if($product->status === 'draft')

            {{-- Tombol Kelola Komposisi --}}
            <a href="{{ route('product.ingredients.index', $product->id) }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-md">
            Kelola Komposisi
            </a> &nbsp;

            {{-- Tombol Ajukan Validasi --}}
            <form method="POST" action="{{ route('validation.submit', $product->id) }}" class="inline">
                @csrf
                <button
                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md">
                    Ajukan Validasi
                </button>
            </form> &nbsp;

        @endif

        {{-- Tombol Cetak Label --}}

        @if ($product->status == 'approved')
            {{-- Tombol Preview / Unduh Label --}}
            <a href="{{ route('products.label.show', $product->id) }}" target="_blank" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded-md border">
                Preview Label
            </a> &nbsp;

            <a href="{{ route('products.label.pdf', $product->id) }}" target="_blank" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                Unduh PDF
            </a>
        @else
            {{-- Tombol Preview / Unduh Label (nonaktif) --}}
            <button class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md border cursor-not-allowed" onclick="alert('Produk harus berstatus Approved untuk mencetak label.')">
                Preview Label
            </button> &nbsp;

            <button class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md border cursor-not-allowed" onclick="alert('Produk harus berstatus Approved untuk mengunduh label.')">
                Unduh PDF
            </button>
        @endif

    </div>
</div>
@endsection
