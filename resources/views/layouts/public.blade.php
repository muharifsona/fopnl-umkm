<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FOPNL-UMKM') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex min-h-screen">

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            {{-- Navbar --}}
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-22 h-8">
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="hover:bg-gray-100 text-whitexx px-3 py-1.5 rounded-md text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('public.products.index') }}" class="hover:bg-gray-100 text-whitexx px-3 py-1.5 rounded-md text-sm font-medium">
                        Daftar Produk
                    </a>
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm font-medium">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium">
                        Register
                    </a>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <footer class="bg-white shadow-inner py-3 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} FOPNL Nutrition Label System
    </footer>
</body>
</html>
