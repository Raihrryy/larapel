<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasAuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('petugas_id')) {
            return redirect()->route('petugas.dashboard');
        }

        return view('petugas.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $petugas = Petugas::where('email', $request->email)->first();

        if (!$petugas || $petugas->password !== $request->password) {
            return back()->withErrors([
                'email' => 'Email atau password petugas tidak sesuai.',
            ])->onlyInput('email');
        }

        if ($petugas->status !== 'Bertugas') {
            return back()->withErrors([
                'email' => 'Akun Anda sedang berstatus Libur. Hubungi Admin untuk mengaktifkan.',
            ])->onlyInput('email');
        }

        session([
            'petugas_id' => $petugas->id,
            'petugas_nama' => $petugas->nama,
            'petugas_email' => $petugas->email,
            'petugas_shift' => $petugas->shift,
        ]);

        return redirect()->route('petugas.dashboard');
    }

    public function logout()
    {
        session()->forget(['petugas_id', 'petugas_nama', 'petugas_email', 'petugas_shift']);
        return redirect()->route('petugas.login');
    }
}