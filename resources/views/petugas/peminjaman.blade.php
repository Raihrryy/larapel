@extends('petugas.admin')

@section('header', 'Transaksi Peminjaman')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold text-sage-900">Riwayat Peminjaman Buku</h2>
                <p class="text-sm text-gray-500 font-light mt-0.5">Kelola sirkulasi peminjaman dan pengembalian buku.</p>
            </div>
            <a href="#" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Catat Peminjaman
            </a>
        </div>
        
        <div class="text-center py-12 border-2 border-dashed border-sage-200 rounded-lg">
            <p class="text-gray-400 text-sm">Modul transaksi peminjaman siap dihubungkan ke database.</p>
        </div>
    </div>
@endsection