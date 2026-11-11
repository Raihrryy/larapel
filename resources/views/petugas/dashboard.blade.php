@extends('petugas.admin')

@section('header', 'Dashboard Utama')

@section('content')
    <!-- Kartu Statistik Singkat -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Total Buku -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Koleksi Buku</p>
                <h3 class="text-3xl font-bold text-sage-900 mt-1">24</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-sage-100 flex items-center justify-center text-sage-600 text-xl">
                📚
            </div>
        </div>

        <!-- Card 2: Data Siswa -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Siswa Terdaftar</p>
                <h3 class="text-3xl font-bold text-sage-900 mt-1">150</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-sage-100 flex items-center justify-center text-sage-600 text-xl">
                🎓
            </div>
        </div>

        <!-- Card 3: Peminjaman Aktif -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Sedang Dipinjam</p>
                <h3 class="text-3xl font-bold text-sage-900 mt-1">8</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-sage-100 flex items-center justify-center text-sage-600 text-xl">
                🔄
            </div>
        </div>
    </div>

    <!-- Informasi Selamat Datang / Ringkasan -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-sage-100">
        <h2 class="text-xl font-serif font-bold text-sage-900 mb-2">Selamat Datang di Panel Admin, Petugas!</h2>
        <p class="text-gray-500 font-light leading-relaxed max-w-3xl">
            Sistem manajemen perpustakaan siap digunakan. Gunakan menu di sebelah kiri untuk mengelola data buku, memantau data siswa, atau mencatat transaksi peminjaman buku harian dengan cepat dan efisien.
        </p>
        <div class="mt-6 flex gap-4">
            <a href="/buku" class="bg-sage-900 hover:bg-sage-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Kelola Buku Sekarang →
            </a>
        </div>
    </div>
@endsection