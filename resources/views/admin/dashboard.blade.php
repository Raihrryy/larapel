@extends('admin.layout')

@section('header', 'Dashboard Administrator')

@section('content')
    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Petugas</p>
            <h3 class="text-3xl font-bold text-sage-900 mt-2">{{ $total_petugas }}</h3>
            <p class="text-xs text-gray-500 mt-1">Akun terdaftar</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-sage-600">Sedang Bertugas</p>
            <h3 class="text-3xl font-bold text-sage-900 mt-2">{{ $petugas_bertugas }}</h3>
            <p class="text-xs text-gray-500 mt-1">Petugas aktif hari ini</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Sedang Libur</p>
            <h3 class="text-3xl font-bold text-gray-700 mt-2">{{ $petugas_libur }}</h3>
            <p class="text-xs text-gray-500 mt-1">Tidak dalam jadwal shift</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Stok Buku</p>
            <h3 class="text-3xl font-bold text-sage-900 mt-2">{{ $total_buku }}</h3>
            <p class="text-xs text-gray-500 mt-1">Eksemplar di perpustakaan</p>
        </div>
    </div>

    <!-- Daftar Petugas Aktif Hari Ini -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-lg font-bold text-sage-900">Petugas yang Sedang Bertugas</h2>
                <p class="text-sm text-gray-500 font-light">Daftar petugas dengan status aktif melayani perpustakaan.</p>
            </div>
            <a href="{{ route('admin.petugas.index') }}" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Kelola Semua Petugas →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-sage-100 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-sage-50/50">
                        <th class="py-3 px-4">Nama Petugas</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Jadwal Shift</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sage-100 text-sm text-gray-700">
                    @forelse($daftar_bertugas as $petugas)
                        <tr>
                            <td class="py-3 px-4 font-medium text-sage-900">{{ $petugas->nama }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $petugas->email }}</td>
                            <td class="py-3 px-4">{{ $petugas->shift }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-sage-100 text-sage-900">
                                    {{ $petugas->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-400">Tidak ada petugas yang berstatus Bertugas saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection