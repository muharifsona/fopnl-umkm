@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-0 p-6 bg-white rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Profil Saya</h1>

    <form method="POST" action="{{ route('users.update.self') }}" class="mb-6 grid grid-cols-2 gap-4 items-end">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block text-sm">Nama</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label class="block text-sm">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg p-2" readonly value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label class="block text-sm">Password Baru (opsional)</label>
            <input type="password" name="password" class="w-full border rounded-lg p-2">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="w-full border rounded-lg p-2">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
