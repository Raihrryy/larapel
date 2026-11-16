<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data_peminjaman = Peminjaman::with('buku')->latest()->get();
        $data_buku = Buku::where('stok', '>', 0)->get();

        return view('petugas.peminjaman', compact('data_peminjaman', 'data_buku'));
    }

    // Pengajuan pinjam dari halaman pengunjung
    public function storePengunjung(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'nama_peminjam' => 'required|string|max:255',
            'identitas_peminjam' => 'required|string|max:255',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < 1) {
            return back()->with('error', 'Maaf, stok buku "' . $buku->judul . '" sedang habis.');
        }

        Peminjaman::create([
            'buku_id' => $buku->id,
            'nama_peminjam' => $request->nama_peminjam,
            'identitas_peminjam' => $request->identitas_peminjam,
            'jumlah' => 1,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'Menunggu',
        ]);

        return back()->with('success', 'Permintaan pinjam buku "' . $buku->judul . '" terkirim! Silakan temui petugas di meja layanan.');
    }

    // Pencatatan peminjaman langsung oleh petugas
    public function storePetugas(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'nama_peminjam' => 'required|string|max:255',
            'identitas_peminjam' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi! Sisa stok tersedia: ' . $buku->stok . ' buku.');
        }

        $buku->decrement('stok', $request->jumlah);

        Peminjaman::create([
            'buku_id' => $buku->id,
            'nama_peminjam' => $request->nama_peminjam,
            'identitas_peminjam' => $request->identitas_peminjam,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'Dipinjam',
        ]);

        return back()->with('success', 'Transaksi peminjaman berhasil dicatat dan stok buku otomatis berkurang!');
    }

    // Setujui pengajuan pengunjung
    public function setujui($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->status !== 'Menunggu') {
            return back();
        }

        if ($peminjaman->buku->stok < $peminjaman->jumlah) {
            return back()->with('error', 'Gagal menyetujui: stok buku "' . $peminjaman->buku->judul . '" sudah habis.');
        }

        $peminjaman->buku->decrement('stok', $peminjaman->jumlah);
        $peminjaman->update([
            'status' => 'Dipinjam',
            'tanggal_pinjam' => now()->toDateString(),
        ]);

        return back()->with('success', 'Peminjaman atas nama ' . $peminjaman->nama_peminjam . ' disetujui!');
    }

    // Proses pengembalian buku
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->status === 'Dipinjam') {
            $peminjaman->buku->increment('stok', $peminjaman->jumlah);
            $peminjaman->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali' => now()->toDateString(),
            ]);
        }

        return back()->with('success', 'Buku "' . $peminjaman->buku->judul . '" telah dikembalikan dan stok bertambah!');
    }

    // Hapus data transaksi
    public function destroy($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->status === 'Dipinjam' && $peminjaman->buku) {
            $peminjaman->buku->increment('stok', $peminjaman->jumlah);
        }

        $peminjaman->delete();

        return back()->with('success', 'Data transaksi berhasil dihapus.');
    }
}