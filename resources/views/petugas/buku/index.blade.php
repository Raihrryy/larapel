@extends('petugas.layout')

@section('header', 'Kelola Koleksi Buku')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        @if(session('success'))
            <div class="mb-6 p-4 bg-sage-100 border border-sage-200 text-sage-900 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold text-sage-900">Daftar Buku Perpustakaan</h2>
                <p class="text-sm text-gray-500 font-light mt-0.5">Kelola stok dan informasi buku yang tampil di halaman pengunjung.</p>
            </div>
            <a href="{{ route('petugas.buku.create') }}" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Tambah Buku
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-sage-100 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-sage-50/50">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Judul Buku</th>
                        <th class="py-3 px-4">Penulis</th>
                        <th class="py-3 px-4">Penerbit</th>
                        <th class="py-3 px-4">Tahun</th>
                        <th class="py-3 px-4">Stok</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sage-100 text-sm text-gray-700">
                    @forelse($data_buku as $index => $buku)
                        <tr class="hover:bg-sage-50/50 transition-colors">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 font-medium text-sage-900">{{ $buku->judul }}</td>
                            <td class="py-3 px-4">{{ $buku->penulis }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $buku->penerbit ?? '-' }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $buku->tahun_terbit ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $buku->stok > 0 ? 'bg-sage-100 text-sage-900' : 'bg-red-100 text-red-600' }}">
                                    {{ $buku->stok ?? 0 }} pcs
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center flex justify-center items-center gap-2">
                                <a href="{{ route('petugas.buku.edit', $buku->id) }}" class="text-sage-600 hover:text-sage-900 font-medium">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="{{ route('petugas.buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-gray-400">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection