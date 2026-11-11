<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Library.')</title>
    
    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
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

    <!-- Sidebar Admin Kiri -->
    <aside class="w-64 bg-sage-900 text-white flex flex-col shadow-xl z-20 relative">
        <div class="h-16 flex items-center px-6 border-b border-sage-600/30">
            <span class="text-xl font-bold tracking-wider">Admin<span class="text-sage-500">Panel</span></span>
        </div>
        
        <!-- Menu Sidebar -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="/dashboard" class="block px-3 py-2.5 rounded-lg hover:bg-sage-600 transition-colors {{ request()->is('dashboard') ? 'bg-sage-600 font-medium' : 'text-sage-100' }}">
                📊 Dashboard
            </a>
            <a href="/buku" class="block px-3 py-2.5 rounded-lg hover:bg-sage-600 transition-colors {{ request()->is('buku*') ? 'bg-sage-600 font-medium' : 'text-sage-100' }}">
                📚 Kelola Buku
            </a>
            <a href="/customer" class="block px-3 py-2.5 rounded-lg hover:bg-sage-600 transition-colors {{ request()->is('customer*') ? 'bg-sage-600 font-medium' : 'text-sage-100' }}">
                👥 Data Customer
            </a>
            
            <div class="pt-4 mt-4 border-t border-sage-600/30">
                <a href="/peminjaman" class="block px-3 py-2.5 rounded-lg hover:bg-sage-600 transition-colors text-sage-100">
                    🔄 Transaksi Peminjaman
                </a>
            </div>
        </nav>

        <!-- Tombol kembali ke Web Publik -->
        <div class="p-4 border-t border-sage-600/30">
            <a href="/" class="block w-full text-center px-4 py-2 bg-sage-600 hover:bg-sage-500 rounded-lg text-sm transition-colors text-white">
                Lihat Web Publik
            </a>
        </div>
    </aside>

    <!-- Area Konten Utama Kanan -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <!-- Header Atas Admin -->
        <header class="h-16 bg-white border-b border-sage-100 flex items-center justify-between px-8 z-10 shadow-sm">
            <h1 class="text-xl font-semibold text-sage-900">
                @yield('header', 'Dashboard Utama')
            </h1>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-semibold text-gray-700">Petugas Aktif</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-sage-200 flex items-center justify-center text-sage-900 font-bold border-2 border-sage-500">
                    A
                </div>
            </div>
        </header>

        <!-- Tempat Konten Disisipkan -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-sage-50 p-6 md:p-8">
            @yield('content')
        </main>

    </div>

</body>
</html>