<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FOPNL-UMKM') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md show md:block">
            <div class="flex items-center gap-2 px-4 py-3 border-b">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-22 h-8">
                {{-- <span class="font-bold text-lg text-gray-700">FOPNL</span> --}}
            </div>

            {{-- Dynamic Menu by Role --}}
            <nav class="p-4 space-y-1">
                @if(auth()->check() && auth()->user()->role === 'Admin')

                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                        🧭 Dashboard
                    </a>
                    <a href="{{ route('admin.validation.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.validation.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        ✅ Validasi Produk
                    </a>
                    <a href="{{ route('admin.ingredients.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.ingredients.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        🧂 Kelola Bahan
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        👥 Kelola User
                    </a>
                    <a href="{{ route('admin.audit.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.audit.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        📜 Audit Logs
                    </a>

                @elseif(auth()->check() && auth()->user()->role === 'Regulator')

                    <a href="{{ route('regulator.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('regulator.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                        🧭 Dashboard
                    </a>
                    <a href="{{ route('regulator.validation.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('regulator.validation.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        ✅ Validasi Produk
                    </a>
                    <a href="{{ route('regulator.audit.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('regulator.audit.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        📜 Audit Logs
                    </a>

                @elseif(auth()->check() && auth()->user()->role === 'UMKM')

                    <a href="{{ route('umkm.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('umkm.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                        🏠 Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('products.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        🍞 Produk Saya
                    </a>

                @endif
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            {{-- Navbar --}}
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <button id="menu-btn" class="md:hidden text-gray-600">
                    ☰
                </button>
                <h1 class="text-lg font-semibold">
                    {{ $title ?? '' }}
                </h1>
                <div class="flex items-center gap-4">
                    <a href="{{ route('users.edit.self') }}"><span class="text-sm text-gray-700">{{ auth()->user()->name ?? '' }}</span></a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium">Logout</button>
                    </form>
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

    {{-- Mobile Sidebar Toggle --}}
    <script>
        document.getElementById('menu-btn')?.addEventListener('click', () => {
            const aside = document.querySelector('aside');
            aside.classList.toggle('hidden');
        });
    </script>
</body>
</html>
