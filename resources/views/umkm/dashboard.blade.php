@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Dashboard UMKM</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-600">Total Produk</p>
            <p class="text-3xl font-bold">{{ $totalProducts }}</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg shadow text-center">
            <p class="text-gray-600">Menunggu Validasi</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $submitted }}</p>
        </div>
        <div class="bg-green-50 p-4 rounded-lg shadow text-center">
            <p class="text-gray-600">Disetujui</p>
            <p class="text-3xl font-bold text-green-600">{{ $approved }}</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg shadow text-center">
            <p class="text-gray-600">Ditolak</p>
            <p class="text-3xl font-bold text-red-600">{{ $rejected }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Lihat Daftar Produk
        </a>
    </div>
</div>
@endsection
