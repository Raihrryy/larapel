<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library. &mdash; Perpustakaan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
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
                        sage: { 50: '#f8faf7', 100: '#eef2ec', 200: '#dce5d8', 500: '#7a9c76', 600: '#5e7d5a', 900: '#2c3e29' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sage-50 text-gray-800 font-sans antialiased">

    <!-- Navbar Khusus Pengunjung -->
    <nav id="navbar" class="fixed top-0 w-full bg-white/85 backdrop-blur-md border-b border-sage-100 z-40 transition-transform duration-300">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="#beranda" class="text-2xl font-serif font-bold text-sage-900 tracking-tight">
                Library<span class="text-sage-500">.</span>
            </a>

            <div class="flex items-center gap-6 text-sm">
                <a href="#beranda" class="text-gray-600 hover:text-sage-900 font-medium transition-colors">Beranda</a>
                <a href="#katalog" class="text-gray-600 hover:text-sage-900 font-medium transition-colors">Katalog Buku</a>
                <a href="#info" class="text-gray-600 hover:text-sage-900 font-medium transition-colors">Jam Layanan</a>
                <a href="{{ route('petugas.login') }}" class="px-3.5 py-1.5 rounded-lg bg-sage-100 hover:bg-sage-200 text-sage-900 font-medium transition-colors">
                    Login Petugas
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="beranda" class="pt-32 pb-16 px-6 max-w-6xl mx-auto text-center">
        @if(session('success'))
            <div class="max-w-xl mx-auto mb-6 p-4 rounded-xl bg-sage-900 text-white text-sm shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-xl mx-auto mb-6 p-4 rounded-xl bg-red-600 text-white text-sm shadow-md">
                {{ session('error') }}
            </div>
        @endif

        <span class="inline-block px-3 py-1 rounded-full bg-sage-100 text-sage-600 text-xs font-semibold tracking-wide uppercase mb-4">
            Perpustakaan Umum &amp; Sekolah
        </span>
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-sage-900 leading-tight max-w-2xl mx-auto">
            Temukan &amp; Pinjam Buku Favoritmu dengan Mudah.
        </h1>
        <p class="text-gray-500 mt-4 max-w-xl mx-auto font-light">
            Jelajahi koleksi buku yang tersedia di rak perpustakaan kami dan ajukan peminjaman langsung di meja layanan petugas.
        </p>

        <!-- Search Bar -->
        <div class="mt-8 max-w-lg mx-auto">
            <input type="text" id="searchInput" onkeyup="filterBooks()" placeholder="Cari judul buku atau nama penulis..." class="w-full px-4 py-3 rounded-xl bg-white border border-sage-200 focus:outline-none focus:ring-2 focus:ring-sage-500 text-sm shadow-sm">
        </div>
    </header>

    <!-- Katalog Buku -->
    <section id="katalog" class="max-w-6xl mx-auto px-6 pb-20">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-serif font-bold text-sage-900">Koleksi Buku Tersedia</h2>
            <span class="text-xs text-gray-500">Pilih buku untuk meminjam</span>
        </div>

        <div id="bookGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($data_buku as $buku)
                <div class="book-card bg-white p-6 rounded-2xl border border-sage-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-md {{ ($buku->stok ?? 0) > 0 ? 'bg-sage-100 text-sage-900' : 'bg-red-50 text-red-600' }}">
                                {{ ($buku->stok ?? 0) > 0 ? 'Tersedia: ' . $buku->stok . ' buku' : 'Stok Habis' }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $buku->tahun_terbit ?? '-' }}</span>
                        </div>
                        <h3 class="book-title text-lg font-bold text-sage-900 mb-1">{{ $buku->judul }}</h3>
                        <p class="book-author text-sm text-gray-500 mb-4">Penulis: {{ $buku->penulis }}</p>
                    </div>

                    <button onclick="bukaModalPinjam({{ $buku->id }}, '{{ addslashes($buku->judul) }}')" {{ ($buku->stok ?? 0) <= 0 ? 'disabled' : '' }}
                        class="w-full py-2.5 rounded-xl text-sm font-medium transition-colors {{ ($buku->stok ?? 0) > 0 ? 'bg-sage-900 hover:bg-sage-600 text-white' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                        {{ ($buku->stok ?? 0) > 0 ? 'Pinjam Buku Ini' : 'Tidak Tersedia' }}
                    </button>
                </div>
            @empty
                <div class="col-span-3 bg-white p-12 rounded-2xl border border-sage-100 text-center">
                    <p class="text-gray-400 text-sm">Belum ada koleksi buku yang ditampilkan saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Modal Pengajuan Pinjam Pengunjung -->
    <div id="modalPengunjung" class="hidden fixed inset-0 bg-black/40 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl border border-sage-100">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-lg font-serif font-bold text-sage-900">Ajukan Peminjaman Buku</h3>
                <button onclick="tutupModalPinjam()" class="text-gray-400 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <p id="modalJudulBuku" class="text-sm text-sage-600 font-medium mb-4"></p>

            <form action="{{ route('pengunjung.pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="buku_id" id="modalBukuId">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama_peminjam" required placeholder="Masukkan nama kamu" class="w-full px-3.5 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas / Nomor WhatsApp</label>
                    <input type="text" name="identitas_peminjam" required placeholder="Contoh: XI RPL 1 / 0812xxx" class="w-full px-3.5 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="tutupModalPinjam()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-sage-900 hover:bg-sage-600 text-white rounded-xl text-sm font-medium">
                        Kirim Permintaan Pinjam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Informasi Jam Layanan Pengunjung -->
    <footer id="info" class="bg-white border-t border-sage-100 py-12 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
            <div>
                <span class="font-serif font-bold text-sage-900 text-lg">Library<span class="text-sage-500">.</span></span>
                <p class="text-xs mt-1">Buka Senin &ndash; Sabtu, pukul 07:00 &ndash; 17:00 WIB.</p>
            </div>
            <p class="text-xs text-gray-400">Silakan hubungi petugas di meja sirkulasi untuk pengambilan buku fisik.</p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="hidden fixed bottom-6 right-6 w-11 h-11 rounded-full bg-sage-900 text-white shadow-lg hover:bg-sage-600 transition-all items-center justify-center">
        &uarr;
    </button>

    <script>
        let lastScroll = 0;
        const navbar = document.getElementById('navbar');
        const backToTop = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > lastScroll && currentScroll > 80) {
                navbar.classList.add('-translate-y-full');
            } else {
                navbar.classList.remove('-translate-y-full');
            }
            lastScroll = currentScroll;

            if (currentScroll > 300) {
                backToTop.classList.remove('hidden');
                backToTop.classList.add('flex');
            } else {
                backToTop.classList.add('hidden');
                backToTop.classList.remove('flex');
            }
        });

        function filterBooks() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.book-card').forEach(card => {
                const title = card.querySelector('.book-title').innerText.toLowerCase();
                const author = card.querySelector('.book-author').innerText.toLowerCase();
                card.style.display = (title.includes(query) || author.includes(query)) ? 'flex' : 'none';
            });
        }

        function bukaModalPinjam(id, judul) {
            document.getElementById('modalBukuId').value = id;
            document.getElementById('modalJudulBuku').innerText = 'Buku: ' + judul;
            document.getElementById('modalPengunjung').classList.remove('hidden');
        }

        function tutupModalPinjam() {
            document.getElementById('modalPengunjung').classList.add('hidden');
        }
    </script>
</body>
</html>