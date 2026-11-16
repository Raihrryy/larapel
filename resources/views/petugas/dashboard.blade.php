@extends('petugas.layout')

@section('header', 'Dashboard Petugas')

@section('content')
    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Judul Koleksi</p>
            <h3 class="text-3xl font-bold text-sage-900 mt-2">{{ $total_judul }}</h3>
            <p class="text-xs text-gray-500 mt-1">Judul buku terdaftar</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-sage-600">Stok Tersedia</p>
            <h3 class="text-3xl font-bold text-sage-900 mt-2">{{ $total_stok }}</h3>
            <p class="text-xs text-gray-500 mt-1">Buku siap dipinjam di rak</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Menunggu Persetujuan</p>
            <h3 class="text-3xl font-bold text-amber-600 mt-2">{{ $menunggu_persetujuan }}</h3>
            <p class="text-xs text-gray-500 mt-1">Pengajuan dari pengunjung</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-600">Sedang Dipinjam</p>
            <h3 class="text-3xl font-bold text-sage-900 mt-2">{{ $sedang_dipinjam }}</h3>
            <p class="text-xs text-gray-500 mt-1">Buku belum dikembalikan</p>
        </div>
    </div>

    <!-- Peminjaman Aktif & Menunggu -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-lg font-bold text-sage-900">Antrean & Peminjaman Aktif</h2>
                <p class="text-sm text-gray-500 font-light">Halo {{ session('petugas_nama') }}, berikut transaksi yang perlu ditindaklanjuti.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('petugas.buku.create') }}" class="bg-sage-100 hover:bg-sage-200 text-sage-900 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    + Tambah Buku
                </a>
                <a href="{{ route('petugas.peminjaman.index') }}" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Kelola Peminjaman →
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-sage-100 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-sage-50/50">
                        <th class="py-3 px-4">Peminjam</th>
                        <th class="py-3 px-4">Identitas / Kelas</th>
                        <th class="py-3 px-4">Judul Buku</th>
                        <th class="py-3 px-4">Tgl Pinjam</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sage-100 text-sm text-gray-700">
                    @forelse($peminjaman_terbaru as $item)
                        <tr>
                            <td class="py-3 px-4 font-medium text-sage-900">{{ $item->nama_peminjam }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $item->identitas_peminjam }}</td>
                            <td class="py-3 px-4">{{ $item->buku->judul ?? '-' }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->tanggal_pinjam }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->status == 'Menunggu' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400">Belum ada permintaan atau peminjaman aktif saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection