<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan - Soleia Hotel</title>
    <!-- Tambahkan baris ini untuk mengubah ikon favicon browser -->
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

<body class="bg-[#f4f3ef] text-[#1a1a1a] pt-28 pb-12 px-4 selection:bg-[#1b3022] selection:text-white">


    <div class="max-w-[1100px] mx-auto">

        <!-- Judul Halaman -->
        <div class="mb-10 text-center">
            <h2 class="text-2xl md:text-3xl font-semibold text-[#1b3022] mb-1 tracking-wide">Formulir Pemesanan</h2>
            <p class="text-xs text-stone-500 tracking-wider uppercase font-medium">Lengkapi data reservasi kamar Soleia
                Hotel Anda</p>
        </div>

        <!-- Layout 2 Kolom: Kiri & Kanan -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

            <!-- KOLOM KIRI: Ringkasan Kamar & Rincian Harga -->
            <div class="lg:col-span-5 bg-white rounded-3xl shadow-lg p-6 flex flex-col justify-between">

                <div class="flex flex-col gap-5">
                    <!-- Bagian Gambar -->
                    <div class="relative h-52 rounded-2xl overflow-hidden shadow-inner bg-stone-100">
                        <img src="{{ asset($currentRoom['image']) }}" alt="Kamar {{ $tipeKamar }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Wadah Informasi Kamar -->
                    <div class="bg-[#f7f6f2] border border-stone-200/60 rounded-2xl p-4 flex flex-col gap-3.5">
                        <div>
                            <h3 class="text-xl font-bold text-[#1b3022]">{{ $tipeKamar }}</h3>
                            <p class="text-xs text-stone-500 mt-0.5">{{ $currentRoom['subtitle'] }}</p>
                        </div>

                        <div class="border-t border-stone-200"></div>

                        <div class="flex flex-col gap-2 text-xs text-stone-700">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-[#1b3022]" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M2 4v16M2 8h20v12M2 17h20M6 8v3M10 8v3" />
                                </svg>
                                <span>Kasur: <strong class="text-stone-900">{{ $currentRoom['bed'] }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-[#1b3022]" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3a1 1 0 0 1 1-1zM6 12V5a2 2 0 0 1 2-2h1M4 21v-2M20 21v-2" />
                                </svg>
                                <span>Kamar Mandi: <strong
                                        class="text-stone-900">{{ $currentRoom['baths'] }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-[#1b3022]" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M3 3h18v18H3zM9 3v18M15 3v18M3 9h18M3 15h18" />
                                </svg>
                                <span>Luas: <strong class="text-stone-900">{{ $currentRoom['sqft'] }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <hr class="border-stone-300">

                    <!-- Rincian Harga Awal Kosong -->
                    <div class="flex flex-col gap-3 text-sm text-stone-600 px-1">
                        <div class="flex justify-between items-center">
                            <span>Harga Kamar (<span id="summaryDurasi">-</span> Malam)</span>
                            <span class="font-medium text-stone-800" id="subtotalKamarText">Rp -</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Sarapan (Breakfast)</span>
                            <span class="font-medium text-stone-800" id="subtotalBreakfastText">Rp -</span>
                        </div>
                        <div class="flex justify-between items-center text-amber-700" id="diskonRow"
                            style="display: none;">
                            <span id="diskonLabel">Diskon (10% > 3 Hari)</span>
                            <span class="font-medium" id="diskonAmountText">-Rp -</span>
                        </div>
                    </div>
                </div>

                <!-- Bagian Bawah Card Kiri: Total Pembayaran -->
                <div class="mt-6 pt-4 border-t border-stone-300 px-1">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-stone-800 text-base">Total Bayar</span>
                        <span id="totalBayarText" class="text-2xl font-bold text-[#1b3022]">Rp -</span>
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN: Form Pemesanan -->
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-lg p-8 flex flex-col justify-between">

                <!-- Notifikasi Error dengan Warna Senada Kotak Sukses -->
                @if ($errors->any())
                    <div
                        class="mb-6 bg-stone-100 border border-stone-200 text-stone-700 px-6 py-4 rounded-full text-xs font-medium text-center shadow-sm flex items-center justify-center gap-2">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('pemesanan.store') }}" method="POST"
                    class="flex flex-col gap-4 h-full justify-between" id="formPemesanan">
                    @csrf

                    <div class="flex flex-col gap-4">
                        <!-- 1. Nama Pemesan -->
                        <div
                            class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center focus-within:border-[#1b3022] focus-within:bg-white focus-within:ring-1 focus-within:ring-[#1b3022] transition">
                            <label class="text-xs text-stone-500 font-medium mb-1" for="nama">Nama Pemesan*</label>
                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap"
                                value="{{ old('nama') }}"
                                class="w-full bg-transparent border-none outline-none font-medium text-sm text-[#1a1a1a]"
                                required>
                        </div>

                        <!-- 2. Email Pemesan -->
                        <div
                            class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center focus-within:border-[#1b3022] focus-within:bg-white focus-within:ring-1 focus-within:ring-[#1b3022] transition">
                            <label class="text-xs text-stone-500 font-medium mb-1" for="email">Email*</label>
                            <input type="email" id="email" name="email" placeholder="Contoh: nama@domain.com"
                                value="{{ old('email') }}"
                                class="w-full bg-transparent border-none outline-none font-medium text-sm text-[#1a1a1a]"
                                required>
                        </div>

                        <!-- 3. Nomor Identitas -->
                        <div
                            class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center focus-within:border-[#1b3022] focus-within:bg-white focus-within:ring-1 focus-within:ring-[#1b3022] transition">
                            <label class="text-xs text-stone-500 font-medium mb-1" for="no_identitas">Nomor
                                Identitas*</label>
                            <input type="text" id="no_identitas" name="no_identitas"
                                placeholder="Masukkan 16 digit nomor identitas" minlength="16" maxlength="16"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                value="{{ old('no_identitas') }}"
                                class="w-full bg-transparent border-none outline-none font-medium text-sm text-[#1a1a1a]"
                                required>
                        </div>

                        <!-- 4. Durasi Menginap & Tanggal Pesan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center focus-within:border-[#1b3022] focus-within:bg-white focus-within:ring-1 focus-within:ring-[#1b3022] transition">
                                <label class="text-xs text-stone-500 font-medium mb-1" for="durasi">Durasi Menginap
                                    (Hari)*</label>
                                <input type="number" id="durasi" name="durasi" min="1"
                                    placeholder="Masukkan jumlah hari" value="{{ old('durasi') }}"
                                    class="w-full bg-transparent border-none outline-none font-medium text-sm text-[#1a1a1a]"
                                    required>
                            </div>

                            <div
                                class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center focus-within:border-[#1b3022] focus-within:bg-white focus-within:ring-1 focus-within:ring-[#1b3022] transition">
                                <label class="text-xs text-stone-500 font-medium mb-1" for="tanggal">Tanggal
                                    Pesan*</label>
                                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                                    class="w-full bg-transparent border-none outline-none font-medium text-sm text-[#1a1a1a]"
                                    required>
                            </div>
                        </div>

                        <!-- 5. Jenis Kelamin & Termasuk Breakfast -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center">
                                <span class="text-xs text-stone-500 font-medium mb-1.5">Jenis Kelamin*</span>
                                <div class="flex gap-4 items-center text-sm">
                                    <label class="flex gap-1.5 items-center cursor-pointer font-medium text-stone-800">
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}
                                            class="w-4 h-4 accent-[#1b3022]" required> Laki-laki
                                    </label>
                                    <label class="flex gap-1.5 items-center cursor-pointer font-medium text-stone-800">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}
                                            class="w-4 h-4 accent-[#1b3022]"> Perempuan
                                    </label>
                                </div>
                            </div>

                            <div
                                class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center">
                                <span class="text-xs text-stone-500 font-medium mb-1.5">Termasuk Breakfast*</span>
                                <label
                                    class="flex gap-2 items-center cursor-pointer text-sm font-medium text-stone-800">
                                    <input type="checkbox" id="breakfast" name="breakfast" value="1" {{ old('breakfast') ? 'checked' : '' }} class="w-4 h-4 accent-[#1b3022]"> Ya (+Rp 80rb/hr)
                                </label>
                            </div>
                        </div>

                        <!-- 6. Tipe Kamar & Harga / Malam -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center">
                                <label class="text-xs text-stone-500 font-medium mb-1" for="tipe_kamar">Tipe
                                    Kamar*</label>
                                <input type="text" id="tipe_kamar_display" value="{{ $tipeKamar }}" readonly
                                    class="w-full bg-transparent border-none outline-none font-semibold text-sm text-[#1b3022]">
                                <input type="hidden" name="tipe_kamar" value="{{ $tipeKamar }}">
                            </div>

                            <div
                                class="bg-[#f7f6f2] border border-stone-200 rounded-2xl px-5 py-3 flex flex-col justify-center">
                                <label class="text-xs text-stone-500 font-medium mb-1" for="harga">Harga / Malam</label>
                                <input type="text" id="harga" value="Rp {{ number_format($harga, 0, ',', '.') }}"
                                    readonly
                                    class="w-full bg-transparent border-none outline-none font-medium text-sm text-stone-500"
                                    data-raw-harga="{{ $harga }}">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi di Bawah Form (Disesuaikan dengan Style Navbar) -->
                    <div class="flex gap-4 mt-6 pt-4 border-t border-stone-200">
                        <!-- Tombol Kembali -->
                        <a href="{{ route('home') }}"
                            class="flex-1 py-3 px-6 rounded-full font-normal text-center text-[#44403c] bg-stone-100 hover:bg-[#16291c] hover:text-white transition-all duration-300 text-xs tracking-wide shadow-sm flex items-center justify-center">
                            Kembali
                        </a>

                        <!-- Tombol Simpan Pemesanan -->
                        <button type="submit"
                            class="flex-1 py-3 px-6 rounded-full font-normal text-center text-white bg-[#16291c] hover:bg-[#122017] transition-all duration-300 text-xs tracking-wide shadow-md flex items-center justify-center">
                            Simpan Pemesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Kalkulasi Harga -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const durasiInput = document.getElementById('durasi');
            const breakfastCheckbox = document.getElementById('breakfast');
            const hargaSatuan = parseInt(document.getElementById('harga').getAttribute('data-raw-harga')) || 0;

            const summaryDurasi = document.getElementById('summaryDurasi');
            const subtotalKamarText = document.getElementById('subtotalKamarText');
            const subtotalBreakfastText = document.getElementById('subtotalBreakfastText');
            const diskonRow = document.getElementById('diskonRow');
            const diskonAmountText = document.getElementById('diskonAmountText');
            const totalBayarText = document.getElementById('totalBayarText');

            function hitungTotal() {
                let durasi = parseInt(durasiInput.value);

                if (isNaN(durasi) || durasi <= 0) {
                    summaryDurasi.textContent = '-';
                    subtotalKamarText.textContent = 'Rp -';
                    subtotalBreakfastText.textContent = 'Rp -';
                    diskonRow.style.display = 'none';
                    totalBayarText.textContent = 'Rp -';
                    return;
                }

                summaryDurasi.textContent = durasi;

                let totalKamar = hargaSatuan * durasi;
                subtotalKamarText.textContent = 'Rp ' + totalKamar.toLocaleString('id-ID');

                let totalBreakfast = 0;
                if (breakfastCheckbox.checked) {
                    totalBreakfast = 80000 * durasi;
                }
                subtotalBreakfastText.textContent = 'Rp ' + totalBreakfast.toLocaleString('id-ID');

                let diskon = 0;
                if (durasi > 3) {
                    diskon = totalKamar * 0.10;
                    diskonRow.style.display = 'flex';
                    diskonAmountText.textContent = '-Rp ' + diskon.toLocaleString('id-ID');
                } else {
                    diskonRow.style.display = 'none';
                }

                let finalTotal = (totalKamar - diskon) + totalBreakfast;
                totalBayarText.textContent = 'Rp ' + finalTotal.toLocaleString('id-ID');
            }

            durasiInput.addEventListener('input', hitungTotal);
            durasiInput.addEventListener('change', hitungTotal);
            breakfastCheckbox.addEventListener('change', hitungTotal);

            hitungTotal();
        });
    </script>

</body>

</html>