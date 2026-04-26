@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Kelola Komposisi: {{ $product->name }}</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form tambah bahan --}}
    <form method="POST" action="{{ route('product.ingredients.store', $product) }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Bahan</label>
            <select name="ingredient_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200">
                <option value="">-- Pilih Bahan --</option>
                @foreach($ingredients as $i)
                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (gram)</label>
            <input type="number" step="0.01" name="quantity_g"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200">
        </div>

        <div class="flex items-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium w-full">
                + Tambah Bahan
            </button>
        </div>
    </form>

    {{-- Form Pencarian API FatSecret --}}
    <div class="mt-8 mb-8 p-5 bg-blue-50 border border-blue-200 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold mb-3 text-blue-800">Atau Cari Bahan Baru dari FatSecret API</h3>
        <form method="GET" action="{{ route('product.ingredients.index', $product) }}" class="flex items-center gap-3 mb-4">
            <input type="text" name="search" value="{{ $searchQuery ?? '' }}"
                   placeholder="Ketik nama bahan (contoh: Apple, Chicken)..."
                   class="border-gray-300 p-2 rounded-md w-full md:w-2/3 shadow-sm focus:border-blue-500 focus:ring-blue-200">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900 transition">
                Cari di API
            </button>
            @if(!empty($searchQuery))
                <a href="{{ route('product.ingredients.index', $product) }}" class="text-gray-500 underline hover:text-gray-700">Reset</a>
            @endif
        </form>

        {{-- Hasil Pencarian API FatSecret --}}
        @if(!empty($apiIngredients))
            <h4 class="text-md font-bold mb-3 text-blue-800">
                Hasil Pencarian FatSecret (Telah difilter per 100g)
            </h4>
            <ul class="flex flex-col gap-3">
                @foreach($apiIngredients as $apiFood)
                    <li class="bg-white p-4 border border-blue-100 rounded-lg flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-sm hover:shadow-md transition">
                        <div class="flex-1">
                            <strong class="text-gray-800">{{ $apiFood['food_name'] }}</strong>
                            <p class="text-xs text-gray-500 mt-1">{{ $apiFood['food_description'] }}</p>
                        </div>

                        <form method="POST" action="{{ route('product.ingredients.store', $product) }}" class="flex flex-wrap items-center gap-2">
                            @csrf
                            <input type="hidden" name="fatsecret_id" value="{{ $apiFood['food_id'] }}">
                            <input type="hidden" name="name" value="{{ $apiFood['food_name'] }}">

                            <input type="number" step="0.1" min="0.1" name="quantity_g"
                                   placeholder="Berat (g)" required
                                   class="border-gray-300 p-1.5 rounded-md text-sm w-24 shadow-sm focus:border-blue-500 focus:ring-blue-200" title="Berat bahan yang digunakan dalam resep">

                            <input type="text" name="notes"
                                   placeholder="Catatan (ops)"
                                   class="border-gray-300 p-1.5 rounded-md text-sm w-32 shadow-sm focus:border-blue-500 focus:ring-blue-200">

                            <button type="submit" class="bg-green-600 text-white px-4 py-1.5 rounded-md hover:bg-green-700 text-sm font-medium shadow transition">
                                Gunakan
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @elseif(!empty($searchQuery))
            <div class="p-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-md text-sm">
                Bahan "<strong>{{ $searchQuery }}</strong>" tidak ditemukan, atau tidak memiliki takaran per 100g beserta rincian gizi lengkap di database FatSecret. Silakan gunakan kata kunci lain.
            </div>
        @endif
    </div>

    {{-- Daftar bahan produk --}}
    <table class="min-w-full border border-gray-200 text-sm">
        <thead class="bg-gray-50 text-gray-700">
            <tr>
                <th class="px-3 py-2 border-b text-left">Nama Bahan</th>
                <th class="px-3 py-2 border-b text-left">Jumlah (g)</th>
                <th class="px-3 py-2 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productIngredients as $pi)
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2 border-b">{{ $pi->ingredient->name }}</td>
                    <td class="px-3 py-2 border-b">{{ $pi->quantity_g }}</td>
                    <td class="px-3 py-2 border-b">
                        <form action="{{ route('product.ingredients.destroy', [$product, $pi]) }}" method="POST" onsubmit="return confirm('Hapus bahan ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Belum ada bahan ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6 flex justify-center gap-4">
        <a href="{{ route('products.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-md font-medium">
            ← Kembali ke Produk
        </a>
        <a href="{{ route('products.edit', $product) }}"
            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md font-medium">
            Edit Produk
        </a>

        {{-- Tombol Kelola Komposisi --}}
        <a href="{{ route('product.nutrition.show', $product) }}"
        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md font-medium">
            Hitung Nilai Gizi
        </a>
    </div>
</div>
@endsection
