<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Tambahkan baris ini supaya Laravel tahu nama tabelnya 'pemesanan'
    protected $table = 'pemesanan';

    protected $fillable = [
        'nama',
        'email',
        'jenis_kelamin',
        'no_identitas',
        'tipe_kamar',
        'harga',
        'tanggal',
        'durasi',
        'breakfast',
        'total_bayar',
    ];
}