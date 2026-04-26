@extends('layouts.app')

@section('content')
<div class="px-3 max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Detail Validasi Produk</h2>

    {{-- Informasi Produk --}}
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h3 class="text-xl font-bold mb-2">{{ $validationRequest->product->name }}</h3>
        <p class="text-gray-700">{{ $validationRequest->product->description ?? '-' }}</p>

        <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
            <p><strong>UMKM:</strong> {{ $validationRequest->submitter->name ?? '-' }}</p>
            <p><strong>Status:</strong>
                <span class="font-semibold
                    @if($validationRequest->status === 'submitted') text-yellow-600
                    @elseif($validationRequest->status === 'approved') text-green-600
                    @elseif($validationRequest->status === 'rejected') text-red-600
                    @endif">
                    {{ ucfirst($validationRequest->status) }}
                </span>
            </p>
            <p><strong>Diajukan:</strong> {{ $validationRequest->submitted_at?->format('d M Y H:i') }}</p>
            @if($validationRequest->reviewed_at)
                <p><strong>Direview:</strong> {{ $validationRequest->reviewed_at?->format('d M Y H:i') }}</p>
            @endif
        </div>

        @if($validationRequest->notes)
            <div class="mt-3 bg-gray-50 p-3 rounded border border-gray-200">
                <strong>Catatan:</strong>
                <p class="text-gray-700">{{ $validationRequest->notes }}</p>
            </div>
        @endif
    </div>

    {{-- Ringkasan Nilai Gizi --}}
    @if($validationRequest->product->nutritionSummary)
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h3 class="text-lg font-semibold mb-3">Ringkasan Nilai Gizi per Sajian</h3>

        @php
            $ns = $validationRequest->product->nutritionSummary;
        @endphp

        <table class="w-full border-collapse border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1 text-left">Nutrisi</th>
                    <th class="border px-2 py-1 text-right">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr><td class="border px-2 py-1">Energi (kkal)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_energy_kcal ?? '-' }}</td></tr>
                <tr><td class="border px-2 py-1">Protein (g)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_protein_g ?? '-' }}</td></tr>
                <tr><td class="border px-2 py-1">Lemak (g)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_fat_g ?? '-' }}</td></tr>
                <tr><td class="border px-2 py-1">Lemak Jenuh (g)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_saturated_fat_g ?? '-' }}</td></tr>
                <tr><td class="border px-2 py-1">Karbohidrat (g)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_carbs_g ?? '-' }}</td></tr>
                <tr><td class="border px-2 py-1">Gula (g)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_sugar_g ?? '-' }}</td></tr>
                <tr><td class="border px-2 py-1">Natrium (mg)</td><td class="border px-2 py-1 text-right">{{ $ns->per_serving_sodium_mg ?? '-' }}</td></tr>
            </tbody>
        </table>
    </div>
    @endif

    {{-- Komposisi Bahan --}}
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h3 class="text-lg font-semibold mb-3">Komposisi Bahan</h3>
        @if($validationRequest->product->ingredients->isEmpty())
            <p class="text-gray-500">Tidak ada bahan terdaftar untuk produk ini.</p>
        @else
        <table class="w-full border-collapse border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1 text-left">Nama Bahan</th>
                    <th class="border px-2 py-1 text-right">Jumlah (g)</th>
                    <th class="border px-2 py-1 text-left">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($validationRequest->product->ingredients as $ing)
                <tr>
                    <td class="border px-2 py-1">{{ $ing->name }}</td>
                    <td class="border px-2 py-1 text-right">{{ $ing->pivot->quantity_g }}</td>
                    <td class="border px-2 py-1">{{ $ing->pivot->notes ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    {{-- Form Validasi --}}
    @if($validationRequest->status === 'submitted')
    <div class="bg-white shadow rounded-lg p-5">
        <h3 class="text-lg font-semibold mb-3">Tindakan Validasi</h3>

        <form action="{{ route('admin.validation.approve', $validationRequest->id) }}" method="POST" class="mb-3">
            @csrf
            <textarea name="notes" class="w-full border rounded p-2" rows="2" placeholder="Catatan validasi (opsional)"></textarea>
            <button class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Setujui Produk</button>
        </form>

        <form action="{{ route('admin.validation.reject', $validationRequest->id) }}" method="POST">
            @csrf
            <textarea name="notes" class="w-full border rounded p-2" rows="2" placeholder="Alasan penolakan"></textarea>
            <button class="mt-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Tolak Produk</button>
        </form>
    </div>
    @else
    <div class="bg-gray-50 border border-gray-200 p-4 rounded text-sm text-gray-600">
        Validasi produk ini telah selesai (status: <strong>{{ ucfirst($validationRequest->status) }}</strong>).
    </div>
    @endif
</div>
@endsection
