@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-0 p-6 bg-white rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Pengguna</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="mb-6 grid grid-cols-3 gap-4 items-end">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block text-sm">Nama</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="w-full border rounded-lg p-2" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="w-full border rounded-lg p-2">
                <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="UMKM" {{ $user->role === 'UMKM' ? 'selected' : '' }}>UMKM</option>
                <option value="Regulator" {{ $user->role === 'Regulator' ? 'selected' : '' }}>Regulator</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-700 text-center">Kembali</a>
    </form>
</div>
@endsection
