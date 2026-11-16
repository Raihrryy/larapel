<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin - Library.')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        sage: { 50: '#f8faf7', 100: '#eef2ec', 200: '#dce5d8', 500: '#7a9c76', 600: '#5e7d5a', 900: '#2c3e29' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sage-50 font-sans text-gray-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar Khusus Admin -->
    <aside class="w-64 bg-sage-900 text-white flex flex-col shadow-xl z-20">
        <div class="h-16 flex items-center px-6 border-b border-sage-600/30">
            <span class="text-xl font-bold tracking-wider">Admin<span class="text-sage-500">Utama</span></span>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-lg hover:bg-sage-600 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sage-600 font-medium' : 'text-sage-100' }}">
                📊 Dashboard Admin
            </a>
            <a href="{{ route('admin.petugas.index') }}" class="block px-3 py-2.5 rounded-lg hover:bg-sage-600 transition-colors {{ request()->routeIs('admin.petugas.*') ? 'bg-sage-600 font-medium' : 'text-sage-100' }}">
                🧑‍💼 Atur Petugas Bertugas
            </a>
        </nav>

        <div class="p-4 border-t border-sage-600/30 space-y-2">
            <a href="{{ route('pengunjung.index') }}" class="block w-full text-center px-4 py-2 bg-sage-600 hover:bg-sage-500 rounded-lg text-sm transition-colors text-white">
                Lihat Halaman Pengunjung
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-center px-4 py-2 bg-red-500/20 hover:bg-red-500 text-red-200 hover:text-white rounded-lg text-sm transition-colors">
                    Keluar (Logout)
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Utama Admin -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-16 bg-white border-b border-sage-100 flex items-center justify-between px-8 shadow-sm">
            <h1 class="text-xl font-semibold text-sage-900">@yield('header', 'Dashboard Admin')</h1>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-sage-600">{{ Auth::user()->email }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-sage-200 flex items-center justify-center text-sage-900 font-bold border-2 border-sage-500">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto bg-sage-50 p-6 md:p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>