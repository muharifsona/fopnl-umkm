@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-0 p-6 bg-white rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-2">Riwayat Aktivitas Sistem</h1>

    <form method="GET" class="mb-2 grid grid-cols-3 gap-4 items-end">
        <div class="mb-0">
            <label class="block text-sm">Entity</label>
            <input type="text" name="entity" class="w-full border rounded-lg p-2" value="{{ request('entity') }}" placeholder="Cari entity (contoh: Product)">
        </div>
        <div class="mb-0">
            <label class="block text-sm">Action</label>
            <input type="text" name="action" class="w-full border rounded-lg p-2" value="{{ request('action') }}" placeholder="Cari aksi (create/update/delete)">
        </div>
        <div class="mb-0">
            <label class="block text-sm">Performed By (ID User)</label>
            <input type="text" name="performed_by" class="w-full border rounded-lg p-2" value="{{ request('performed_by') }}" placeholder="ID user">
        </div>
        <div class="mb-0">
            <button class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700" type="submit">Filter</button>
            <a href="{{ url()->current() }}" class="bg-gray-400 text-white px-3 py-2 rounded-lg hover:bg-gray-700 text-center">Reset</a>
        </div>
    </form>

    <div class="table-responsive shadow-sm rounded">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-3 py-2 border-b text-left">#</th>
                    <th class="px-3 py-2 border-b text-left">Entity</th>
                    <th class="px-3 py-2 border-b text-left">ID Entitas</th>
                    <th class="px-3 py-2 border-b text-left">Aksi</th>
                    <th class="px-3 py-2 border-b text-left">Pelaku</th>
                    <th class="px-3 py-2 border-b text-left">Detail</th>
                    <th class="px-3 py-2 border-b text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2 border">{{ $loop->iteration + ($logs->currentPage() - 1) * $logs->perPage() }}</td>
                        <td class="p-2 border">{{ $log->entity }}</td>
                        <td class="p-2 border">{{ $log->entity_id }}</td>
                        <td class="p-2 border">
                            <span class="badge
                                @if($log->action === 'create') bg-success
                                @elseif($log->action === 'update') bg-warning
                                @elseif($log->action === 'delete') bg-danger
                                @else bg-secondary @endif">
                                {{ strtoupper($log->action) }}
                            </span>
                        </td>
                        <td class="p-2 border">{{ $log->user->name ?? 'System' }} (ID: {{ $log->performed_by }})</td>
                        <td class="p-2 border" style="max-width: 400px; white-space: pre-wrap;">{{ $log->details }}</td>
                        <td class="p-2 border">{{ $log->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">Tidak ada aktivitas yang tercatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $logs->links() }}
    </div>
</div>
@endsection
