@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-0 p-6 bg-white rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Kelola Data Bahan & Nilai Gizi</h1>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form tambah bahan -->
    <form method="POST" action="{{ route('admin.ingredients.store') }}" class="mb-6 grid grid-cols-3 gap-4 items-end">
        @csrf
        <div>
            <label class="block text-sm">Nama Bahan</label>
            <input name="name" class="w-full border rounded-lg p-2" required>
        </div>
        <div>
            <label class="block text-sm">Satuan Default</label>
            <input name="default_measure" class="w-full border rounded-lg p-2" placeholder="g" required>
        </div>
        <div class="text-right">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah</button>
        </div>
    </form>

    <!-- Import Excel -->
    <form method="POST" action="{{ route('admin.ingredients.import') }}" enctype="multipart/form-data" class="mb-6 flex items-center gap-3 bg-gray-50 p-3 rounded">
        @csrf
        <input type="file" name="file" accept=".xlsx,.xls" required class="border p-2 rounded w-1/3">
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Import Excel</button>
        <a href="{{ asset('template/ingredients_template.xlsx') }}" class="text-blue-600 underline ml-2">Download Template</a>
    </form>

    <!-- Tabel bahan -->
    <div class="overflow-x-auto">
        <table class="min-w-full border rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Energi (kcal)</th>
                    <th class="p-2 border">Protein (g)</th>
                    <th class="p-2 border">Lemak (g)</th>
                    <th class="p-2 border">Karbo (g)</th>
                    <th class="p-2 border">Gula (g)</th>
                    <th class="p-2 border">Natrium (mg)</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredients as $ing)
                <tr class="border-b hover:bg-gray-50">
                    <form method="POST" action="{{ route('admin.ingredients.update', $ing->id) }}">
                        @csrf @method('PUT')
                        <td class="p-2 border">{{ $ing->name }}</td>
                        <td class="p-2 border"><input type="number" step="0.1" name="per_100g_energy_kcal" value="{{ $ing->nutrition->per_100g_energy_kcal ?? 0 }}" class="w-20 border rounded"></td>
                        <td class="p-2 border"><input type="number" step="0.1" name="per_100g_protein_g" value="{{ $ing->nutrition->per_100g_protein_g ?? 0 }}" class="w-20 border rounded"></td>
                        <td class="p-2 border"><input type="number" step="0.1" name="per_100g_fat_g" value="{{ $ing->nutrition->per_100g_fat_g ?? 0 }}" class="w-20 border rounded"></td>
                        <td class="p-2 border"><input type="number" step="0.1" name="per_100g_carbs_g" value="{{ $ing->nutrition->per_100g_carbs_g ?? 0 }}" class="w-20 border rounded"></td>
                        <td class="p-2 border"><input type="number" step="0.1" name="per_100g_sugar_g" value="{{ $ing->nutrition->per_100g_sugar_g ?? 0 }}" class="w-20 border rounded"></td>
                        <td class="p-2 border"><input type="number" step="0.1" name="sodium_mg" value="{{ $ing->nutrition->sodium_mg ?? 0 }}" class="w-20 border rounded"></td>
                        <td class="p-2 border text-center">
                            <button role="button" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Simpan</button>

                            <form method="POST" action="{{ route('admin.ingredients.destroy', $ing->id) }}"
                                onsubmit="return confirm('Yakin ingin menghapus bahan {{ $ing->name }}?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
