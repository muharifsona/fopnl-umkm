{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="mb-4 p-4 rounded-md bg-green-100 text-green-800 border border-green-300">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 rounded-md bg-red-100 text-red-800 border border-red-300">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-700">Daftar Produk</h1>
        <a href="{{ route('products.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
            + Tambah Produk
        </a>
    </div>

    <table class="min-w-full border border-gray-200 text-sm">
        <thead class="bg-gray-50 text-gray-700">
            <tr>
                <th class="px-3 py-2 border-b text-left">Nama</th>
                <th class="px-3 py-2 border-b text-left">Berat Bersih</th>
                <th class="px-3 py-2 border-b text-left">Serving Size</th>
                <th class="px-3 py-2 border-b text-left">Status</th>
                <th class="px-3 py-2 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $p)
            <tr class="hover:bg-gray-50">
                <td class="px-3 py-2 border-b">{{ $p->name }}</td>
                <td class="px-3 py-2 border-b">{{ $p->net_weight ?? '-' }} g</td>
                <td class="px-3 py-2 border-b">{{ $p->serving_size ?? '-' }}</td>
                <td class="px-3 py-2 border-b">
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $p->status === 'validated' ? 'bg-green-100 text-green-700' :
                           ($p->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                           'bg-gray-100 text-gray-700') }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td class="px-3 py-2 border-b space-x-0">
                    @if($p->status === 'submitted')

                        <span class="text-gray-400 italic">Menunggu Validasi...</span>

                    @elseif ($p->status === 'draft')

                        {{-- Tombol Kelola Komposisi --}}
                        <a href="{{ route('product.ingredients.index', $p) }}"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md">
                            Komposisi
                        </a>

                        {{-- Tombol Kelola Komposisi --}}
                        <a href="{{ route('product.nutrition.show', $p) }}"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md">
                            Hitung Nilai Gizi
                        </a>

                        {{-- Tombol Edit Produk --}}
                        <a href="{{ route('products.edit', $p) }}"
                        class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('products.destroy', $p) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">
                                Hapus
                            </button>
                        </form>

                    @else

                        {{-- Tombol Kelola Komposisi --}}
                        <a href="{{ route('product.nutrition.show', $p) }}"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md">
                            Detail Product
                        </a>

                    @endif

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
