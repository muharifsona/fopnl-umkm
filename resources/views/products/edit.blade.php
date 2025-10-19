@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Produk</h1>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                class="w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Berat Bersih --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Berat Bersih (gram)</label>
            <input type="number" step="0.01" name="net_weight" value="{{ old('net_weight', $product->net_weight) }}"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
        </div>

        {{-- Serving Size --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Serving Size</label>
            <input type="text" name="serving_size" value="{{ old('serving_size', $product->serving_size) }}"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('products.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md font-medium">
                Kembali
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">
                Update Produk
            </button>
        </div>
    </form>
</div>
@endsection
