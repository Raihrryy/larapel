<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library.</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        sage: {
                            50: '#f8faf7',
                            100: '#eef2ec',
                            200: '#dce5d8',
                            500: '#7a9c76',
                            600: '#5e7d5a',
                            900: '#2c3e29',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sage-50 text-gray-800 font-sans antialiased selection:bg-sage-200 selection:text-sage-900 relative">

    <!-- Navbar dengan ID untuk efek Scroll -->
    <nav id="navbar" class="bg-sage-50/90 backdrop-blur-md fixed top-0 w-full z-50 border-b border-sage-100 transition-transform duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="text-2xl font-serif font-bold text-sage-900 tracking-tight italic">
                    Library.
                </a>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-sm font-medium text-sage-900 border-b-2 border-sage-500 pb-0.5">Beranda</a>
                    <a href="/buku" class="text-sm font-medium text-gray-500 hover:text-sage-600 transition-colors">Koleksi</a>
                    <a href="/siswa" class="text-sm font-medium text-gray-500 hover:text-sage-600 transition-colors">Siswa</a>
                    <a href="/petugas" class="text-sm font-medium text-gray-500 hover:text-sage-600 transition-colors">Petugas</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Dibuat lebih padat) -->
    <header class="max-w-7xl mx-auto px-6 lg:px-8 pt-28 pb-12 text-center flex flex-col items-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-sage-900 leading-tight mb-4 max-w-3xl">
            Temukan Dunia Baru dalam <span class="italic text-sage-600">Setiap Halaman.</span>
        </h1>
        <p class="text-base text-gray-500 mb-8 max-w-2xl font-light">
            Jelajahi ribuan koleksi literatur secara cepat. Mulai dari modul kejuruan, rekayasa perangkat lunak, hingga sastra.
        </p>
        
        <!-- Search Bar -->
        <div class="w-full max-w-xl relative shadow-sm rounded-full group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-sage-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" class="w-full pl-12 pr-4 py-3 rounded-full border border-sage-200 focus:border-sage-500 focus:ring-2 focus:ring-sage-200 bg-white text-gray-700 outline-none transition-all placeholder-gray-400 font-light text-base" placeholder="Cari judul buku, penulis, atau ISBN...">
            <button class="absolute inset-y-1.5 right-1.5 bg-sage-900 hover:bg-sage-600 text-white px-5 rounded-full text-sm font-medium transition-colors">
                Cari
            </button>
        </div>
    </header>

    <!-- Kategori / Tema Section (Jarak dirapatkan) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-6 border-t border-sage-100">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <h2 class="text-lg font-serif font-semibold text-sage-900 min-w-max">Jelajahi Tema</h2>
            <div class="flex flex-wrap gap-2 justify-end">
                <a href="#" class="px-4 py-1.5 rounded-full border border-sage-200 bg-white text-sm text-gray-600 hover:border-sage-500 hover:text-sage-900 transition-all">💻 Web Development</a>
                <a href="#" class="px-4 py-1.5 rounded-full border border-sage-200 bg-white text-sm text-gray-600 hover:border-sage-500 hover:text-sage-900 transition-all">🎮 Game Design</a>
                <a href="#" class="px-4 py-1.5 rounded-full border border-sage-200 bg-white text-sm text-gray-600 hover:border-sage-500 hover:text-sage-900 transition-all">🌸 Manga & Sastra</a>
                <a href="#" class="px-4 py-1.5 rounded-full border border-sage-200 bg-white text-sm text-gray-600 hover:border-sage-500 hover:text-sage-900 transition-all">🔬 Mikrokontroler</a>
            </div>
        </div>
    </section>

    <!-- Koleksi Buku Populer (Ditambah jadi 5 kolom agar mengisi ruang) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-serif font-bold text-sage-900 mb-1">Buku Populer</h2>
                <p class="text-sm text-gray-500 font-light">Koleksi yang paling sering dipinjam minggu ini.</p>
            </div>
            <a href="/buku" class="text-sm font-medium text-sage-600 hover:text-sage-900 hidden md:block">Lihat Semua →</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
            <!-- Buku 1 -->
            <div class="group cursor-pointer">
                <div class="aspect-[2/3] w-full bg-sage-200 rounded-md overflow-hidden shadow-sm group-hover:shadow-lg transition-all duration-300 relative mb-3">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=400&auto=format&fit=crop" alt="Buku Web" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-medium text-sm text-sage-900 truncate">Laravel & React Modern</h3>
                <p class="text-xs text-gray-500 mt-0.5">Raihan T. Press</p>
            </div>

            <!-- Buku 2 -->
            <div class="group cursor-pointer">
                <div class="aspect-[2/3] w-full bg-sage-200 rounded-md overflow-hidden shadow-sm group-hover:shadow-lg transition-all duration-300 relative mb-3">
                    <img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?q=80&w=400&auto=format&fit=crop" alt="Buku Game" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-medium text-sm text-sage-900 truncate">Seni Desain Gim</h3>
                <p class="text-xs text-gray-500 mt-0.5">Agate Studio</p>
            </div>

            <!-- Buku 3 -->
            <div class="group cursor-pointer">
                <div class="aspect-[2/3] w-full bg-sage-200 rounded-md overflow-hidden shadow-sm group-hover:shadow-lg transition-all duration-300 relative mb-3">
                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=400&auto=format&fit=crop" alt="Buku Jepang" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-medium text-sm text-sage-900 truncate">Tata Bahasa JLPT N5</h3>
                <p class="text-xs text-gray-500 mt-0.5">Minna no Nihongo</p>
            </div>

            <!-- Buku 4 -->
            <div class="group cursor-pointer">
                <div class="aspect-[2/3] w-full bg-sage-200 rounded-md overflow-hidden shadow-sm group-hover:shadow-lg transition-all duration-300 relative mb-3">
                    <img src="https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?q=80&w=400&auto=format&fit=crop" alt="Buku Sastra" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-medium text-sm text-sage-900 truncate">Sastra & Slice of Life</h3>
                <p class="text-xs text-gray-500 mt-0.5">I. Asano</p>
            </div>

            <!-- Buku 5 -->
            <div class="group cursor-pointer">
                <div class="aspect-[2/3] w-full bg-sage-200 rounded-md overflow-hidden shadow-sm group-hover:shadow-lg transition-all duration-300 relative mb-3">
                    <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?q=80&w=400&auto=format&fit=crop" alt="Buku Hardware" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-medium text-sm text-sage-900 truncate">Mikrokontroler & OLED</h3>
                <p class="text-xs text-gray-500 mt-0.5">Arduino Press</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-sage-100 py-6 mt-4">
        <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-400 font-light">
            &copy; 2026 Library. Sistem Informasi Manajemen.
        </div>
    </footer>

    <!-- Tombol Back to Top melayang -->
    <button id="backToTopBtn" class="fixed bottom-6 right-6 bg-sage-900 hover:bg-sage-600 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 pointer-events-none translate-y-10 z-50 focus:outline-none">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Script Interaksi Scroll -->
    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById('navbar');
        const backToTopBtn = document.getElementById('backToTopBtn');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Logika sembunyikan Navbar saat scroll ke bawah
            if (scrollTop > lastScrollTop && scrollTop > 80) {
                // Scroll down
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scroll up
                navbar.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Untuk Mobile atau responsif

            // Logika munculkan tombol Back to Top
            if (scrollTop > 300) {
                backToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-10');
                backToTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-10');
                backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
            }
        });

        // Aksi klik Back to Top
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>