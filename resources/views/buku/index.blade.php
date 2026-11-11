@extends('petugas.admin')

@section('header', 'Kelola Data Buku')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-sage-900">Daftar Koleksi Buku</h2>
            <a href="{{ route('buku.create') }}" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Tambah Buku
            </a>
        </div>
        
        <div class="text-center py-10 border-2 border-dashed border-sage-200 rounded-lg">
            <p class="text-gray-500 text-sm">Tabel data hasil seeder akan kita tampilkan di sini.</p>
        </div>
    </div>
@endsection