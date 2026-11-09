<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Pesanan - Soleia Hotel</title>
    <!-- Favicon Logo -->
    <link rel="icon" href="{{ asset('image/LogoSoleia.png') }}" type="image/png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f4f3ef] text-[#1a1a1a] pt-28 pb-16 px-4 selection:bg-[#1b3022] selection:text-white">

    <!-- Panggil Navigasi Mengapung -->
    @include('Navigasi')

    <!-- Kontainer diperlebar dari 800px menjadi 1050px agar card lebih besar -->
    <div class="max-w-[1050px] mx-auto">
        <!-- Judul Halaman -->
        <h2 class="text-2xl md:text-3xl font-semibold text-[#1b3022] mb-1 text-center tracking-wide">Rincian Pemesanan
        </h2>
        <p class="text-xs text-stone-500 text-center mb-10 tracking-wider uppercase font-medium">Bukti Reservasi Kamar
            Soleia Hotel</p>

        <!-- Flash Message Sukses -->
        @if(session('success'))
            <div
                class="bg-[#1b3022]/10 border border-[#1b3022]/20 text-[#1b3022] px-5 py-3 rounded-2xl text-xs mb-8 font-medium text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar Card Data Pemesanan -->
        <div class="flex flex-col gap-6">
            @forelse($pemesanans as $pesanan)
                @php
                    // Menentukan gambar otomatis berdasarkan tipe kamar
                    $roomImage = match ($pesanan->tipe_kamar) {
                        'Standar' => 'image/kamar 1.jpeg',
                        'Deluxe' => 'image/kamar 2.jpeg',
                        'Executive' => 'image/kamar 3.png',
                        default => 'image/kamar 1.jpeg',
                    };
                @endphp

                <div
                    class="bg-white rounded-3xl shadow-xl border border-stone-200/70 p-6 sm:p-8 flex flex-col md:flex-row gap-8 items-center">

                    <!-- KOLOM KIRI: Foto Tipe Kamar (Diperbesar ukurannya) -->
                    <div
                        class="w-full md:w-[320px] h-60 md:h-72 rounded-2xl overflow-hidden shadow-inner bg-stone-100 shrink-0">
                        <img src="{{ asset($roomImage) }}" alt="Kamar {{ $pesanan->tipe_kamar }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- KOLOM KANAN: Detail Rincian Pesanan -->
                    <div class="w-full flex-1 flex flex-col justify-between gap-5">

                        <!-- Header Card: Tipe Kamar & Tanggal Check-in -->
                        <div class="flex justify-between items-center border-b border-stone-100 pb-4">
                            <div>
                                <span
                                    class="text-[10px] uppercase tracking-widest text-stone-400 font-semibold block mb-0.5">Tipe
                                    Kamar</span>
                                <h3 class="text-xl font-bold text-[#1b3022]">{{ $pesanan->tipe_kamar }}</h3>
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-[10px] uppercase tracking-widest text-stone-400 font-semibold block mb-0.5">Tanggal
                                    Check-in</span>
                                <span
                                    class="text-sm font-semibold text-stone-700">{{ date('d M Y', strtotime($pesanan->tanggal)) }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3.5 gap-x-8 text-xs col-span-full">
                            <div
                                class="flex items-center justify-between sm:justify-start gap-2 py-1.5 border-b border-stone-50">
                                <span class="text-stone-400 w-32 shrink-0">Nama Pemesan</span>
                                <span class="font-medium text-stone-800 truncate">: {{ $pesanan->nama }}</span>
                            </div>
                            <div
                                class="flex items-center justify-between sm:justify-start gap-2 py-1.5 border-b border-stone-50">
                                <span class="text-stone-400 w-32 shrink-0">Email</span>
                                <span class="font-medium text-stone-800 truncate">: {{ $pesanan->email }}</span>
                            </div>
                            <div
                                class="flex items-center justify-between sm:justify-start gap-2 py-1.5 border-b border-stone-50">
                                <span class="text-stone-400 w-32 shrink-0">Nomor Identitas</span>
                                <span class="font-medium text-stone-800 truncate">: {{ $pesanan->no_identitas }}</span>
                            </div>
                            <div
                                class="flex items-center justify-between sm:justify-start gap-2 py-1.5 border-b border-stone-50">
                                <span class="text-stone-400 w-32 shrink-0">Jenis Kelamin</span>
                                <span class="font-medium text-stone-800 truncate">: {{ $pesanan->jenis_kelamin }}</span>
                            </div>
                            <div
                                class="flex items-center justify-between sm:justify-start gap-2 py-1.5 border-b border-stone-50">
                                <span class="text-stone-400 w-32 shrink-0">Durasi Menginap</span>
                                <span class="font-medium text-stone-800 truncate">: {{ $pesanan->durasi }} Hari</span>
                            </div>
                            <div
                                class="flex items-center justify-between sm:justify-start gap-2 py-1.5 border-b border-stone-50">
                                <span class="text-stone-400 w-32 shrink-0">Diskon/Breakfast</span>
                                <span class="font-medium text-[#16291c] truncate">:
                                    {{ $pesanan->durasi > 3 ? '10%' : '0%' }} |
                                    {{ $pesanan->breakfast ? 'Ya' : 'Tidak' }}</span>
                            </div>
                        </div>

                        <!-- Bagian Bawah: Total Pembayaran -->
                        <div
                            class="bg-[#faf9f5] border border-stone-200/60 rounded-2xl p-4 sm:p-5 flex justify-between items-center mt-2">
                            <div>
                                <span class="text-[10px] uppercase tracking-wider text-stone-400 block font-semibold">Total
                                    Pembayaran</span>
                                <span class="text-xs text-[#1b3022] font-semibold">Status: Berhasil Dipesan</span>
                            </div>
                            <span class="text-xl sm:text-2xl font-bold text-[#1b3022]">Rp
                                {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
                        </div>

                    </div>

                </div>
            @empty
                <!-- Tampilan Jika Belum Ada Data Pemesanan -->
                <div
                    class="bg-white rounded-3xl shadow-lg p-12 text-center flex flex-col items-center justify-center gap-4">
                    <p class="text-stone-500 text-xs">Belum ada data pemesanan kamar yang tersimpan.</p>
                    <a href="{{ route('beranda') }}"
                        class="px-6 py-3 bg-[#1b3022] text-white rounded-xl text-xs font-semibold hover:bg-[#122017] transition">
                        Pesan Kamar Sekarang
                    </a>
                </div>
            @endforelse
        </div>

    </div>

</body>

</html>