<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pemesanan - Soleia Hotel</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #eef0ec;
            color: #1a1a1a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        /* Style Struk Nota ala Referensi dengan Efek Gerigi di Bawah */
        .receipt-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 28px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            padding: 36px 28px;
            position: relative;
            border: 1px solid #e4e2dd;
        }
        
        /* Efek Gerigi Khas Struk di Bagian Bawah */
        .receipt-card::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background: radial-gradient(circle, transparent, transparent 50%, #ffffff 50%, #ffffff 100%);
            background-size: 16px 20px;
        }

        @media print {
            body { background: #ffffff; padding: 0; display: block; }
            .receipt-card { box-shadow: none; border: none; max-width: 100%; width: 100%; border-radius: 0; }
            .receipt-card::after { display: none; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="receipt-card">
        
        <!-- Bagian Atas: Ikon/Logo & Status Pembayaran -->
        <div class="flex flex-col items-center text-center pb-6 border-b border-dashed border-stone-200">
            <div class="w-14 h-14 rounded-2xl bg-[#1b3022]/10 flex items-center justify-center mb-3 shadow-inner">
                <!-- Ikon Nota / Logo Soleia -->
                <img src="{{ asset('image/LogoSoleia.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </div>
            <h2 class="text-base font-bold text-[#1b3022] tracking-wide">Payment Successful</h2>
            <p class="text-[11px] text-stone-400 mt-0.5 font-medium tracking-wider uppercase">Soleia Hotel Official Receipt</p>
        </div>

        <!-- Bagian 1: Payment Details -->
        <div class="py-5 space-y-3 text-xs border-b border-dashed border-stone-200">
            <p class="font-bold text-stone-400 uppercase tracking-widest text-[10px] mb-2">Payment Details</p>
            
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Invoice Number</span>
                <span class="font-semibold text-stone-800">#SLH-{{ str_pad($pemesanan->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Order Date</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->created_at ? $pemesanan->created_at->format('d M Y, H:i') : date('d M Y') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Nama Pemesan</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->nama }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Email</span>
                <span class="font-semibold text-stone-800 truncate max-w-[200px]">{{ $pemesanan->email }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Nomor Identitas</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->no_identitas }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Jenis Kelamin</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->jenis_kelamin }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Payment Status</span>
                <span class="bg-[#1b3022] text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full">Successful</span>
            </div>
        </div>

        <!-- Bagian 2: Product Details (Rincian Kamar) -->
        <div class="py-5 space-y-3 text-xs border-b border-stone-200">
            <p class="font-bold text-stone-400 uppercase tracking-widest text-[10px] mb-2">Product Details</p>
            
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Tipe Kamar</span>
                <span class="font-bold text-[#1b3022]">{{ $pemesanan->tipe_kamar }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Tanggal Check-In</span>
                <span class="font-semibold text-stone-800">{{ date('d M Y', strtotime($pemesanan->tanggal)) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Durasi Menginap</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->durasi }} Hari</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-stone-500 font-medium">Diskon & Breakfast</span>
                <span class="font-semibold text-stone-800">{{ $pemesanan->durasi > 3 ? '10%' : '0%' }} | {{ $pemesanan->breakfast ? 'Ya' : 'Tidak' }}</span>
            </div>
            <div class="flex justify-between items-center pt-2">
                <span class="font-bold text-stone-700 text-sm">Total Amount</span>
                <span class="font-bold text-base text-[#1b3022]">Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Tombol Aksi Manual (Hanya muncul di web, hilang saat print) -->
        <div class="pt-6 no-print">
            <button onclick="window.print()" class="w-full py-3 bg-[#1b3022] hover:bg-[#284632] text-white text-xs font-semibold rounded-2xl shadow-lg transition text-center flex items-center justify-center gap-2">
                📥 Download PDF / Print Receipt
            </button>
        </div>

    </div>

</body>
</html>