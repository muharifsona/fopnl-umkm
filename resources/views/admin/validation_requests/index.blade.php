@extends('layouts.app')

@section('content')
<div class="px-3 max-w-6xl mx-auto" x-data="modalHandler()">
    <h1 class="text-2xl font-semibold mb-6">Daftar Permintaan Validasi</h1>

    <table class="min-w-full bg-white rounded-lg shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-sm text-gray-600">
                <th class="px-4 py-2">Produk</th>
                <th class="px-4 py-2">Diajukan Oleh</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr class="border-t">
                <td class="px-4 py-2 font-semibold">{{ $req->product->name }}</td>
                <td class="px-4 py-2">{{ $req->submitter->name ?? '-' }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs
                        @if($req->status == 'submitted') bg-yellow-100 text-yellow-700
                        @elseif($req->status == 'approved') bg-green-100 text-green-700
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($req->status) }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ optional($req->submitted_at)->diffForHumans() ?? '-' }}</td>
                <td class="px-4 py-2 text-center">
                    <button
                        type="button"
                        @click="openModal({
                            id: {{ $req->id }},
                            product: @js($req->product),
                            notes: @js($req->notes),
                            status: '{{ $req->status }}'
                        })"
                        @if ($req->status === 'approved' || $req->status === 'rejected')

                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                            Selesai Validasi

                        @else

                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Proses Validasi...
                        @endif
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- MODAL --}}
    <template x-if="show">
        <div
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            x-cloak
            @click.self="closeModal()">

            <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 overflow-y-auto max-h-[95vh]">
                <h2 class="text-xl font-semibold mb-3" x-text="product.name"></h2>
                <p class="text-gray-700 mb-2" x-text="product.description"></p>
                <p class="text-sm text-gray-500 mb-4">
                    Berat Bersih: <span x-text="product.net_weight"></span> g |
                    Takaran Saji: <span x-text="product.serving_size"></span>
                </p>

                <!-- Komposisi -->
                <h3 class="font-semibold text-lg mb-2">Komposisi</h3>
                <ul class="list-disc ml-6 mb-4">
                    <template x-for="ing in product.ingredients" :key="ing.id">
                        <li>
                            <span x-text="ing.name"></span> -
                            <span x-text="ing.pivot?.quantity_g"></span> g
                        </li>
                    </template>
                </ul>

                <!-- Nilai Gizi -->
                <h3 class="font-semibold text-lg mb-2">Nilai Gizi per Sajian</h3>
                <table class="w-full text-sm border mb-6">
                    <tbody>
                        <tr><td class="p-2">Energi (kkal)</td><td class="p-2 text-right" x-text="product.nutrition_summary?.per_serving_energy_kcal ?? '-'"></td></tr>
                        <tr><td class="p-2">Protein (g)</td><td class="p-2 text-right" x-text="product.nutrition_summary?.per_serving_protein_g ?? '-'"></td></tr>
                        <tr><td class="p-2">Lemak (g)</td><td class="p-2 text-right" x-text="product.nutrition_summary?.per_serving_fat_g ?? '-'"></td></tr>
                        <tr><td class="p-2">Karbohidrat (g)</td><td class="p-2 text-right" x-text="product.nutrition_summary?.per_serving_carbs_g ?? '-'"></td></tr>
                        <tr><td class="p-2">Gula (g)</td><td class="p-2 text-right" x-text="product.nutrition_summary?.per_serving_sugar_g ?? '-'"></td></tr>
                        <tr><td class="p-2">Natrium (mg)</td><td class="p-2 text-right" x-text="product.nutrition_summary?.per_serving_sodium_mg ?? '-'"></td></tr>
                    </tbody>
                </table>

                <!-- Label Gizi -->
                {{-- Label Informasi Nilai Gizi --}}
                <div class="border-4 border-black p-4 w-full text-gray-800 font-sans">
                    <h2 class="text-2xl font-extrabold border-b-8 border-black pb-2 mb-3 uppercase">Informasi Nilai Gizi</h2>

                    <p class="text-sm mb-2">
                        Takaran Saji: <span x-text="product.serving_size"></span><br>
                        Jumlah Sajian per Kemasan: <span x-text="Math.round(product.net_weight / (parseFloat(product.serving_size) || 1))"></span>
                    </p>

                    <div class="border-t-4 border-black my-2"></div>

                    <div class="justify-between font-semibold text-lg">
                        <span>Energi Total</span>
                        <span x-text="product.nutrition_summary?.per_serving_energy_kcal ?? '-'"></span> <span>kkal</span>
                    </div>

                    <div class="border-t border-gray-800 my-2"></div>

                    <p class="text-xs text-gray-600 mb-2">
                        *Persen AKG berdasarkan kebutuhan energi 2100 kkal. Kebutuhan energi Anda mungkin lebih tinggi atau lebih rendah.
                    </p>

                    <table class="w-full text-sm border-t border-black">
                        <tbody>
                            <tr>
                                <td class="py-1">Protein</td>
                                <td class="text-right" x-text="product.nutrition_summary?.per_serving_protein_g ?? '-'"></td>
                                <td class="pl-2">g</td>
                            </tr>
                            <tr>
                                <td class="py-1">Lemak Total</td>
                                <td class="text-right" x-text="product.nutrition_summary?.per_serving_fat_g ?? '-'"></td>
                                <td class="pl-2">g</td>
                            </tr>
                            <tr>
                                <td class="py-1">Karbohidrat Total</td>
                                <td class="text-right" x-text="product.nutrition_summary?.per_serving_carbs_g ?? '-'"></td>
                                <td class="pl-2">g</td>
                            </tr>
                            <tr>
                                <td class="py-1">Gula</td>
                                <td class="text-right" x-text="product.nutrition_summary?.per_serving_sugar_g ?? '-'"></td>
                                <td class="pl-2">g</td>
                            </tr>
                            <tr>
                                <td class="py-1">Natrium</td>
                                <td class="text-right" x-text="product.nutrition_summary?.per_serving_sodium_mg ?? '-'"></td>
                                <td class="pl-2">mg</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="border-t-4 border-black my-2"></div>
                                    {{-- FOPNL TRAFFIC LIGHT --}}
                                    <div class="mt-6">
                                        <h3 class="text-lg font-semibold mb-2">FOPNL Traffic Light (Front-of-Pack Label)</h3>
                                        <div class="flex gap-4 justify-center text-center">
                                            <!-- GULA -->
                                            <div class="flex flex-col items-center">
                                                <div :class="getTrafficColor(product.nutrition_summary?.per_serving_sugar_g, 'sugar')"
                                                    class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                    <span x-text="getTrafficLabel(product.nutrition_summary?.per_serving_sugar_g, 'sugar')"></span>
                                                </div>
                                                <span class="mt-1 text-xs">Gula</span>
                                                <span class="text-[11px]" x-text="(product.nutrition_summary?.per_serving_sugar_g ?? '-') + ' g'"></span>
                                            </div>

                                            <!-- LEMAK -->
                                            <div class="flex flex-col items-center">
                                                <div :class="getTrafficColor(product.nutrition_summary?.per_serving_fat_g, 'fat')"
                                                    class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                    <span x-text="getTrafficLabel(product.nutrition_summary?.per_serving_fat_g, 'fat')"></span>
                                                </div>
                                                <span class="mt-1 text-xs">Lemak</span>
                                                <span class="text-[11px]" x-text="(product.nutrition_summary?.per_serving_fat_g ?? '-') + ' g'"></span>
                                            </div>

                                            <!-- NATRIUM -->
                                            <div class="flex flex-col items-center">
                                                <div :class="getTrafficColor(product.nutrition_summary?.per_serving_sodium_mg, 'sodium')"
                                                    class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                    <span x-text="getTrafficLabel(product.nutrition_summary?.per_serving_sodium_mg, 'sodium')"></span>
                                                </div>
                                                <span class="mt-1 text-xs">Natrium</span>
                                                <span class="text-[11px]" x-text="(product.nutrition_summary?.per_serving_sodium_mg ?? '-') + ' mg'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="border-t-2 border-black my-2"></div>

                <!-- FORM APPROVAL -->
                <form
                    x-show="['submitted', null].includes(status)"
                    :action="`/regulator/validation-requests/${id}`"
                    method="POST">
                    @csrf @method('PUT')

                    <label for="notes" class="block text-sm font-medium mb-1">Catatan / Feedback</label>
                    <textarea
                        id="notes"
                        name="notes"
                        x-model="notes"
                        rows="3"
                        class="w-full border rounded p-2 mb-4"
                        placeholder="Tulis catatan untuk UMKM (opsional)..."></textarea>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" name="status" value="rejected" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Tolak
                        </button>
                        <button type="submit" name="status" value="approved" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Setujui
                        </button>
                    </div>
                </form>

                <!-- Mode Read-Only -->
                <div x-show="['approved', 'rejected'].includes(status)">
                    <label class="block text-sm font-medium mb-1">Catatan / Feedback</label>
                    <p class="w-full border rounded p-2 bg-gray-50 min-h-[60px]" x-text="notes || 'Tidak ada catatan.'"></p>

                    <div class="flex justify-end mt-4">
                        <span
                            class="px-4 py-2 rounded text-white font-semibold"
                            :class="status === 'approved' ? 'bg-green-600' : 'bg-red-600'"
                            x-text="status === 'approved' ? 'Disetujui' : 'Ditolak'">
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </template>

</div>

{{-- Tambahkan Alpine.js --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
function modalHandler() {
    return {
        show: false,
        product: {},
        openModal(data) {
            this.show = true;
            this.id = data.id;
            this.product = data.product;
            this.notes = data.notes ?? '';
            this.status = data.status ?? 'submitted';
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.show = false;
            this.product = {};
        },
        getTrafficColor(value, type) {
            if (!value) return 'bg-gray-400';

            value = parseFloat(value);

            if (type === 'sugar') {
                if (value <= 5) return 'bg-green-500';
                if (value <= 22.5) return 'bg-yellow-400 text-black';
                return 'bg-red-500';
            }

            if (type === 'fat') {
                if (value <= 3) return 'bg-green-500';
                if (value <= 17.5) return 'bg-yellow-400 text-black';
                return 'bg-red-500';
            }

            if (type === 'sodium') {
                if (value <= 120) return 'bg-green-500';
                if (value <= 600) return 'bg-yellow-400 text-black';
                return 'bg-red-500';
            }

            return 'bg-gray-400';
        },
        getTrafficLabel(value, type) {
            if (!value) return '-';
            value = parseFloat(value);

            if (type === 'sugar') {
                if (value <= 5) return 'Rendah';
                if (value <= 22.5) return 'Sedang';
                return 'Tinggi';
            }
            if (type === 'fat') {
                if (value <= 3) return 'Rendah';
                if (value <= 17.5) return 'Sedang';
                return 'Tinggi';
            }
            if (type === 'sodium') {
                if (value <= 120) return 'Rendah';
                if (value <= 600) return 'Sedang';
                return 'Tinggi';
            }
        }
    };
}

</script>
@endsection
