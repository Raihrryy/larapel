<?php

namespace App\Http\Middleware;

use App\Models\Petugas;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetugasAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('petugas_id')) {
            return redirect()->route('petugas.login');
        }

        $petugas = Petugas::find(session('petugas_id'));

        if (!$petugas || $petugas->status !== 'Bertugas') {
            session()->forget(['petugas_id', 'petugas_nama', 'petugas_email', 'petugas_shift']);
            return redirect()->route('petugas.login')->withErrors([
                'email' => 'Sesi berakhir atau jadwal Anda sedang berstatus Libur.',
            ]);
        }

        return $next($request);
    }
}