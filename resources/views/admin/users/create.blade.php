@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-0 p-6 bg-white rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Tambah User Baru</h1>
    <h1></h1>

    <form method="POST" action="{{ route('admin.users.store') }}" class="mb-6 grid grid-cols-2 gap-4 items-end">
        @csrf

        <div class="mb-3">
            <label class="block text-sm">Nama</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Password</label>
            <input type="password" name="password" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Role</label>
            <select name="role" class="w-full border rounded-lg p-2" required>
                {{-- <option value="UMKM">UMKM</option>
                <option value="Admin">Admin</option> --}}
                <option value="Regulator" selected>Regulator</option>
            </select>
        </div>

        <div></div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-400 text-white text-center px-4 py-2 rounded-lg hover:bg-gray-700">Kembali</a>
    </form>
</div>
@endsection
