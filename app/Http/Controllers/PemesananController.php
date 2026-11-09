<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        // Mengambil semua data pemesanan diurutkan dari yang terbaru
        $pemesanans = Pemesanan::latest()->get();

        // Mengarah ke file RincianPemesanan.blade.php
        return view('RincianPemesanan', compact('pemesanans'));
    }

    // Menampilkan formulir pemesanan dengan membawa data tipe kamar jika ada
    public function create(Request $request)
    {
        $tipeKamar = $request->query('tipe', 'Standar');

        // Tentukan harga berdasarkan tipe kamar
        $harga = match ($tipeKamar) {
            'Standar' => 1850000,
            'Deluxe' => 2450000,
            'Executive' => 3679000,
            default => 1850000,
        };

        // Mengirim data detail kamar agar bisa dibaca di view
        $currentRoom = match ($tipeKamar) {
            'Standar' => [
                'image' => 'image/kamar 1.jpeg',
                'subtitle' => 'Tenang, Bersih, Damai, Modern,...',
                'bed' => '1',
                'baths' => '1',
                'sqft' => '60 m²'
            ],
            'Deluxe' => [
                'image' => 'image/kamar 2.jpeg',
                'subtitle' => 'Tenang, Bersih, Damai, Modern,...',
                'bed' => '2',
                'baths' => '2',
                'sqft' => '85 m²'
            ],
            'Executive' => [
                'image' => 'image/kamar 3.png',
                'subtitle' => 'Tenang, Bersih, Damai, Modern,...',
                'bed' => '2',
                'baths' => '2',
                'sqft' => '105 m²'
            ],
            default => [
                'image' => 'image/kamar 1.jpeg',
                'subtitle' => 'Tenang, Bersih, Damai, Modern,...',
                'bed' => '1',
                'baths' => '1',
                'sqft' => '60 m²'
            ],
        };

        // Mengarah ke file FormulirPemesanan.blade.php
        return view('FormulirPemesanan', compact('tipeKamar', 'harga', 'currentRoom'));
    }

    // Memproses penyimpanan dan perhitungan total bayar di backend
    public function store(Request $request)
    {
        // Validasi input sesuai ketentuan LKPD (Nomor Identitas 16 Digit)
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jenis_kelamin' => 'required|string',
            'no_identitas' => 'required|digits:16',
            'tipe_kamar' => 'required|string',
            'tanggal' => 'required|date',
            'durasi' => 'required|integer|min:1',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid (contoh: nama@domain.com).',
            'no_identitas.required' => 'Nomor identitas wajib diisi.',
            'no_identitas.digits' => 'Isian salah.. data harus 16 digit.',
        ]);

        // Tentukan harga dasar
        $hargaDasar = match ($request->tipe_kamar) {
            'Standar' => 1850000,
            'Deluxe' => 2450000,
            'Executive' => 3679000,
            default => 1850000,
        };

        $durasi = (int) $request->durasi;
        $subtotal = $hargaDasar * $durasi;

        // Diskon 10% jika durasi > 3 hari
        $diskon = 0;
        if ($durasi > 3) {
            $diskon = $subtotal * 0.10;
            $subtotal -= $diskon;
        }

        // Tambahan breakfast Rp 80.000 / hari jika dicentang
        $breakfast = $request->has('breakfast') ? true : false;
        if ($breakfast) {
            $subtotal += (80000 * $durasi);
        }

        $gambarKamar = match ($request->tipe_kamar) {
            'Standar' => 'image/kamar 1.jpeg',
            'Deluxe' => 'image/kamar 2.jpeg',
            'Executive' => 'image/kamar 3.png',
            default => 'image/kamar 1.jpeg',
        };

        // Simpan ke Database menggunakan Model Pemesanan
        Pemesanan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_identitas' => $request->no_identitas,
            'tipe_kamar' => $request->tipe_kamar,
            'harga' => $hargaDasar,
            'tanggal' => $request->tanggal,
            'durasi' => $durasi,
            'breakfast' => $breakfast,
            'total_bayar' => $subtotal,
            'image' => $gambarKamar,
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan kamar Anda berhasil! Pihak hotel akan segera menghubungi Anda untuk konfirmasi.');
    }
}