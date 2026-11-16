<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Memaksa Laravel membaca tabel 'buku' (bukan 'bukus')
    protected $table = 'buku';

    // Kolom yang diizinkan untuk disimpan dari form
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];
}