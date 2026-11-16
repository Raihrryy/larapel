<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $data_petugas = Petugas::all();
        return view('admin.petugas.index', compact('data_petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email',
            'shift' => 'required|string',
            'status' => 'required|string',
            'password' => 'required|min:6',
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'shift' => $request->shift,
            'status' => $request->status,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email,' . $id,
            'shift' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        $petugas->nama = $request->nama;
        $petugas->email = $request->email;
        $petugas->shift = $request->shift;
        $petugas->status = $request->status;

        if ($request->filled('password')) {
            $petugas->password = $request->password;
        }

        $petugas->save();

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->status = ($petugas->status === 'Bertugas') ? 'Libur' : 'Bertugas';
        $petugas->save();

        return back()->with('success', 'Status ' . $petugas->nama . ' diubah menjadi ' . $petugas->status . '.');
    }
}