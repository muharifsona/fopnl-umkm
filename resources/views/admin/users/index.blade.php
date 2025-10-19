@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-0 p-6 bg-white rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Daftar Pengguna</h1>

    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-3 py-1 mb-4 rounded hover:bg-blue-600">Tambah User</a>

    <table class="min-w-full border border-gray-200 text-sm">
        <thead class="bg-gray-50 text-gray-700">
            <tr>
                <th class="px-3 py-2 border-b text-left">ID</th>
                <th class="px-3 py-2 border-b text-left">Nama</th>
                <th class="px-3 py-2 border-b text-left">Email</th>
                <th class="px-3 py-2 border-b text-left">Role</th>
                <th class="px-3 py-2 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2 border">{{ $u->id }}</td>
                <td class="p-2 border">{{ $u->name }}</td>
                <td class="p-2 border">{{ $u->email }}</td>
                <td class="p-2 border">{{ $u->role }}</td>
                <td class="p-2 border">
                    <a href="{{ route('admin.users.edit', $u->id) }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
