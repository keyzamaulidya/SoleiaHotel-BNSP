<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Reservasi - Soleia Hotel</title>
    <!-- Google Fonts: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f7f6f2;
            color: #2c3531;
        }
        .receipt-container {
            max-width: 520px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(27, 48, 34, 0.06);
            border: 1px solid rgba(27, 48, 34, 0.08);
            overflow: hidden;
        }
        @media print {
            body { background: #ffffff; padding: 0; margin: 0; }
            .receipt-container { box-shadow: none; border: none; margin: 0 auto; max-width: 100%; border-radius: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="py-10 px-4">

    <div class="receipt-container p-8 md:p-10">
        
        <!-- Header Branding Soleia Hotel -->
        <div class="flex justify-between items-start pb-8 border-b border-stone-100">
            <div>
                <span class="text-[10px] tracking-widest uppercase font-bold text-[#1b3022]/60 bg-[#1b3022]/5 px-3 py-1 rounded-full">
                    Official E-Receipt
                </span>
                <h1 class="text-2xl font-bold text-[#1b3022] mt-3 tracking-tight">Soleia Hotel</h1>
                <p class="text-xs text-stone-400 mt-0.5">Luxury & Minimalist Sanctuary</p>
            </div>
            <div class="text-right">
                <p class="text-xs font-semibold text-stone-700">#SLH-{{ str_pad($pemesanan->id, 4, '0', STR_PAD_LEFT) }}</p>
                <p class="text-[11px] text-stone-400 mt-0.5">{{ $pemesanan->created_at ? $pemesanan->created_at->format('d M Y') : date('d M Y') }}</p>
            </div>
        </div>

        <!-- Status & Informasi Tamu -->
        <div class="py-6 border-b border-stone-100">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-medium text-stone-400 uppercase tracking-wider">Status Reservasi</span>
                <span class="bg-[#1b3022] text-white text-[11px] font-semibold px-3 py-1 rounded-full tracking-wide">
    Confirmed & Paid
</span>
            </div>
            
            <div class="bg-stone-50 rounded-2xl p-4 space-y-2.5">
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">Nama Tamu</span>
                    <span class="font-semibold text-stone-800">{{ $pemesanan->nama }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">Email Kontak</span>
                    <span class="font-semibold text-stone-800">{{ $pemesanan->email }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">Nomor Identitas</span>
                    <span class="font-semibold text-stone-800">{{ $pemesanan->no_identitas }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-stone-500">Jenis Kelamin</span>
                    <span class="font-semibold text-stone-800">{{ $pemesanan->jenis_kelamin }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Kamar & Waktu Menginap -->
        <div class="py-6 border-b border-stone-100 space-y-3">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Detail Akomodasi</p>
            
            <div class="flex justify-between items-center text-xs">
                <span class="text-stone-500">Tipe Kamar</span>
                <span class="font-bold text-[#1b3022] text-sm">{{ $pemesanan->tipe_kamar }} Room</span>
            </div>
            <div class="flex justify-between items-center text-xs">
                <span class="text-stone-500">Tanggal Check-In</span>
                <span class="font-semibold text-stone-800">{{ date('d M Y', strtotime($pemesanan->tanggal)) }}</span>
            </div>
            <div class="flex justify-between items-center text-xs">
                <span class="text-stone-500">Durasi Menginap</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->durasi }} Malam</span>
            </div>
            <div class="flex justify-between items-center text-xs">
                <span class="text-stone-500">Fasilitas Tambahan</span>
                <span class="font-semibold text-stone-800">
                    {{ $pemesanan->durasi > 3 ? 'Diskon 10% | ' : '' }} {{ $pemesanan->breakfast ? 'Include Breakfast' : 'Tanpa Breakfast' }}
                </span>
            </div>
        </div>

        <!-- Total Pembayaran -->
        <div class="py-6 flex justify-between items-center">
            <div>
                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Total Pembayaran</p>
                <p class="text-xs text-stone-500 mt-0.5">Lunas terverifikasi sistem</p>
            </div>
            <div class="text-right">
                <span class="text-xl md:text-2xl font-bold text-[#1b3022]">
                    Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Tombol Aksi (Hilang saat diprint) -->
        <div class="pt-4 flex items-center gap-3 no-print">
            <a href="{{ route('pemesanan.index') }}" 
               class="w-1/2 py-3 bg-stone-100 hover:bg-stone-200 text-stone-600 text-xs font-semibold rounded-full transition text-center shadow-sm">
                Kembali
            </a>
            <button onclick="window.print()" 
                    class="w-1/2 py-3 bg-[#1b3022] hover:bg-[#284632] text-white text-xs font-semibold rounded-full shadow-lg transition text-center flex items-center justify-center gap-2">
                Cetak Nota
            </button>
        </div>

    </div>

</body>
</html>