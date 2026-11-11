<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Sesuaikan dengan model buku yang kamu punya
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        // Sesuaikan pemanggilan data buku jika menggunakan model
        // $data_buku = Buku::all();
        return view('buku.index');
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer',
            'stok' => 'required|integer',
        ]);

        // Simpan ke database buku
        // Buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }
}