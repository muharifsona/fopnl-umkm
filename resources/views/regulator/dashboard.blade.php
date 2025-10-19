@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Dashboard Regulator</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-yellow-50 p-5 rounded-lg shadow text-center">
            <p class="text-gray-600">Menunggu Validasi</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
        </div>
        <div class="bg-green-50 p-5 rounded-lg shadow text-center">
            <p class="text-gray-600">Disetujui</p>
            <p class="text-3xl font-bold text-green-600">{{ $approved }}</p>
        </div>
        <div class="bg-red-50 p-5 rounded-lg shadow text-center">
            <p class="text-gray-600">Ditolak</p>
            <p class="text-3xl font-bold text-red-600">{{ $rejected }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('regulator.validation.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Lihat Permintaan Validasi
        </a>
    </div>
</div>
@endsection
