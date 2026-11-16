@extends('petugas.layout')

@section('header', 'Transaksi Peminjaman')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        @if(session('success'))
            <div class="mb-6 p-4 bg-sage-100 border border-sage-200 text-sage-900 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold text-sage-900">Data Peminjaman & Pengembalian</h2>
                <p class="text-sm text-gray-500 font-light mt-0.5">Setujui permintaan pengunjung, catat peminjaman langsung, dan proses pengembalian buku.</p>
            </div>
            <button onclick="document.getElementById('modalPinjam').classList.remove('hidden')" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Catat Peminjaman Baru
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-sage-100 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-sage-50/50">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Nama Peminjam</th>
                        <th class="py-3 px-4">Kelas / Kontak</th>
                        <th class="py-3 px-4">Buku (Qty)</th>
                        <th class="py-3 px-4">Tgl Pinjam</th>
                        <th class="py-3 px-4">Tgl Kembali</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sage-100 text-sm text-gray-700">
                    @forelse($data_peminjaman as $index => $item)
                        <tr class="hover:bg-sage-50/50 transition-colors">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 font-medium text-sage-900">{{ $item->nama_peminjam }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $item->identitas_peminjam }}</td>
                            <td class="py-3 px-4">
                                <span class="font-medium">{{ $item->buku->judul ?? 'Buku Terhapus' }}</span>
                                <span class="text-xs text-gray-400">({{ $item->jumlah }} pcs)</span>
                            </td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->tanggal_pinjam }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->tanggal_kembali ?? '-' }}</td>
                            <td class="py-3 px-4">
                                @if($item->status == 'Menunggu')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Menunggu</span>
                                @elseif($item->status == 'Dipinjam')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Dipinjam</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-sage-100 text-sage-900">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    @if($item->status == 'Menunggu')
                                        <form action="{{ route('petugas.peminjaman.setujui', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-sage-900 hover:bg-sage-600 text-white rounded-md text-xs font-medium transition-colors">
                                                Setujui
                                            </button>
                                        </form>
                                    @elseif($item->status == 'Dipinjam')
                                        <form action="{{ route('petugas.peminjaman.kembalikan', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-xs font-medium transition-colors">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('petugas.peminjaman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus catatan transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium px-2">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-10 text-center text-gray-400">Belum ada transaksi peminjaman tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form Catat Peminjaman Baru -->
    <div id="modalPinjam" class="hidden fixed inset-0 bg-black/40 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl border border-sage-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-sage-900">Catat Peminjaman Baru</h3>
                <button onclick="document.getElementById('modalPinjam').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <form action="{{ route('petugas.peminjaman.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Buku</label>
                    <select name="buku_id" required class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                        <option value="">-- Pilih Judul Buku --</option>
                        @foreach($data_buku as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->judul }} (Stok: {{ $buku->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" required placeholder="Contoh: Budi Santoso" class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas / No. HP</label>
                    <input type="text" name="identitas_peminjam" required placeholder="Contoh: XI RPL 1 / 0812xxx" class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Pinjam</label>
                        <input type="number" name="jumlah" value="1" min="1" required class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modalPinjam').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-sage-900 hover:bg-sage-600 text-white rounded-lg text-sm font-medium">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection