@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Kelola Komposisi: {{ $product->name }}</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
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
