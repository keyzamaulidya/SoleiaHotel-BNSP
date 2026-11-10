<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soleia Hotel</title>
    <!-- Tambahkan baris ini untuk mengubah ikon favicon browser -->
    <link rel="icon" href="{{ asset('image/LogoSoleia.png') }}" type="image/png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* CONTAINER SEKSI ABOUT */
        .about-section {
            background-color: #f0eee9;
            padding: 5rem 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about-container {
            max-width: 1080px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 3rem;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .about-container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 4rem;
            }

            .about-text-box {
                width: 52%;
            }

            .about-image-box {
                width: 40%;
            }
        }

        /* PENATAAN TEKS */
        .about-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.85rem;
            line-height: 1.3;
            color: #1a1a1a;
            font-weight: 300;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
        }

        .about-title em {
            font-style: italic;
            font-weight: 300;
        }

        .about-desc {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.825rem;
            line-height: 1.6;
            color: #4a4945;
            font-weight: 400;
        }

        .about-desc p {
            margin-bottom: 1.2rem;
        }

        .about-desc p:last-child {
            margin-bottom: 0;
        }

        /* BINGKAI GAMBAR ABOUT */
        .about-image-wrapper {
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .about-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ========================================= */
        /* STYLE GALERI                              */
        /* ========================================= */
        .gallery-section {
            background-color: #f0eee9;
            padding: 1rem 0 5rem 0;
            width: 100%;
            display: flex;
            justify-content: center;
            overflow: hidden;
        }

        .gallery-wrapper {
            display: flex;
            justify-content: center;
            gap: 16px;
            width: calc(100% + 120px);
            margin-left: -60px;
            margin-right: -60px;
        }

        .gallery-item {
            flex: 1 1 0px;
            height: 440px;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .gallery-wrapper {
                width: calc(100% + 80px);
                margin-left: -40px;
                margin-right: -40px;
                gap: 10px;
            }

            .gallery-item {
                height: 320px;
            }
        }

        /* ========================================= */
        /* STYLE ROOM CARDS & EFEK SOFT HOVER        */
        /* ========================================= */
        .rooms-section {
            background-color: #f0eee9;
            padding: 2rem 2rem 6rem 2rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .rooms-title-wrapper {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .rooms-section-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .rooms-section-subtitle {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.85rem;
            color: #717171;
            letter-spacing: 0.05em;
        }

        .rooms-container {
            max-width: 1100px;
            width: 100%;
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            align-items: stretch;
        }

        .room-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 0.85rem;
            flex: 1;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.1);
        }

        .room-image-wrapper {
            position: relative;
            width: 100%;
            height: 230px;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .room-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .room-card:hover .room-image-wrapper img {
            transform: scale(1.06);
        }

        .booking-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 5;
        }

        .booking-overlay-btn {
            background: rgba(255, 255, 255, 0.95);
            color: #1a1a1a;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 8px 18px;
            border-radius: 20px;
            transform: translateY(10px);
            transition: transform 0.3s ease;
        }

        .room-card:hover .booking-overlay {
            opacity: 1;
        }

        .room-card:hover .booking-overlay-btn {
            transform: translateY(0);
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.25rem;
        }

        .room-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a1a;
            transition: color 0.2s ease;
        }

        .room-card:hover .room-title {
            color: #8c8a84;
        }

        .room-price {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a1a;
            text-align: right;
        }

        .room-price span {
            font-size: 0.75rem;
            font-weight: 400;
            color: #717171;
        }

        .room-subtitle {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            color: #717171;
            margin-bottom: 1.25rem;
        }

        .room-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f0f0f0;
            padding-top: 0.85rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            color: #4a4945;
        }

        .detail-item strong {
            font-weight: 700;
            color: #1a1a1a;
        }

        .detail-item svg {
            width: 15px;
            height: 15px;
            stroke: #4a4945;
            fill: none;
            stroke-width: 1.8;
        }

        .detail-divider {
            width: 1px;
            height: 16px;
            background-color: #e5e5e5;
        }

        @media (max-width: 820px) {
            .rooms-container {
                flex-direction: column;
            }
        }

        /* ========================================= */
        /* STYLE FOOTER                              */
        /* ========================================= */
        .site-footer {
            background-color: #f0eee9;
            padding: 4rem 2rem 2.5rem 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            font-family: 'Montserrat', sans-serif;
            color: #4a4945;
        }

        .footer-container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2.5rem;
        }

        .footer-brand {
            text-align: center;
        }

        .footer-brand h3 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.35rem;
            font-weight: 500;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #1a1a1a;
            margin-bottom: 0.4rem;
        }

        .footer-brand p {
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            color: #8c8a84;
            text-transform: uppercase;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            gap: 2rem;
            padding: 1.5rem 0;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .footer-block {
            flex: 1;
        }

        .footer-block.address {
            text-align: left;
        }

        .footer-block.links {
            text-align: right;
        }

        .footer-label {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #8c8a84;
            font-weight: 600;
            margin-bottom: 0.6rem;
        }

        .footer-block p,
        .footer-block a {
            font-size: 0.825rem;
            line-height: 1.8;
            color: #2c2c2a;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-block a:hover {
            color: #8c8a84;
        }

        .footer-socials {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .footer-bottom {
            text-align: center;
            font-size: 0.7rem;
            color: #a09e97;
            letter-spacing: 0.05em;
        }

        @media (max-width: 640px) {
            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 1.8rem;
            }

            .footer-block.address,
            .footer-block.links {
                text-align: center;
            }
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-900 font-['Montserrat'] antialiased scroll-behavior: smooth;">
    @include('Navigasi')

    <section class="relative w-full h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.5)), url('{{ asset('image/ChatGPT Image Jul 21, 2026, 10_06_12 AM.png') }}');">

        <div style="transform: translateY(55px);"
            class="flex flex-col items-center justify-center text-center text-white px-4 z-10 select-none mx-auto">

            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                <h1 style="color: #ffffff !important; font-family: 'Playfair Display', serif; font-weight: 300 !important; margin: 0 !important;"
                    class="text-4xl sm:text-5xl md:text-6xl font-light tracking-[0.2em] uppercase drop-shadow-md">
                    SOLEIA
                </h1>
                <h1 style="color: #ffffff !important; font-family: 'Playfair Display', serif; font-weight: 300 !important; margin: 0 !important;"
                    class="text-4xl sm:text-5xl md:text-6xl font-light tracking-[0.2em] uppercase drop-shadow-md">
                    HOTEL
                </h1>
            </div>

        </div>

    </section>

    <section id="about" class="about-section">
    <div class="about-container">
        <!-- Bagian Text di Kiri (Tetap Sesuai Asal) -->
        <div class="about-text-box">
            <h2 class="about-title">
                Jelajahi pilihan akomodasi hotel terbaik kami yang dikurasi secara cermat, dirancang khusus untuk
                <em>relaksasi</em> dan <em>pemulihan Anda.</em>
            </h2>

            <div class="about-desc">
                <p>
                    Kemewahan Sejati, bagi kami, melampaui sekadar kemegahan ini adalah tentang pelukan yang
                    tenang, kedamaian, dan kesejahteraan yang menyertainya. Dari kamar eksklusif hingga layanan yang
                    tak tertandingi, Soleia Hotel mengkhususkan diri dalam merancang pengalaman menginap yang
                    otentik bagi para tamu kami.
                </p>
                <p>
                    Untuk informasi, reservasi, dan kunjungan, Anda dapat mendatangi langsung hotel kami di
                    <strong>Jl. Raya Nusa Dua Selatan No. 88, Kuta Selatan, Badung, Bali 80363, Indonesia</strong>.
                    Anda juga bisa menghubungi layanan pelanggan kami melalui WhatsApp di <strong>+62
                    812-3456-7890</strong> atau melalui website resmi kami di
                    <strong>www.soleiahotel.com</strong>. Pelarian Luar Biasa Anda Dimulai Di Sini...
                </p>
            </div>
        </div>

        <!-- Bagian Video di Kanan (Format Potret Tunggal yang Rapi) -->
        <div class="about-image-box">
            <div class="about-image-wrapper" style="width: 100%; max-width: 280px; aspect-ratio: 9 / 16; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); margin: 0 auto;">
                <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover;">
                    <source src="{{ asset('image/video2_hasil_edit.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>
        </div>
    </div>
</section>

    <section class="gallery-section">
        <div class="gallery-wrapper">
            <div class="gallery-item">
                <img src="{{ asset('image/Belmond Jimbaran Puri _ Luxury Resort in Bali.jpeg') }}"
                    alt="Pemandangan Kolam Soleia Resort">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('image/The Asa Maia Resort - Earth Lines Architects.jpeg') }}"
                    alt="Dek Laut Soleia Resort">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('image/download - 2026-07-21T083755.650.jpeg') }}"
                    alt="Area Kesehatan Soleia Resort">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('image/Tropical Bathroom Inspiration — Relax Villas by Vastu Villa.jpeg') }}"
                    alt="Vila Soleia Resort">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('image/JOALI BEING.jpeg') }}" alt="Spa Soleia Resort">
            </div>
        </div>
    </section>

    <section id="rooms" class="rooms-section">
        <div class="rooms-title-wrapper">
            <h2 class="rooms-section-title">Kamar & Suite</h2>
            <p class="rooms-section-subtitle">Pilih tempat peristirahatan sempurna yang disesuaikan untuk kenyamanan
                Anda</p>
        </div>

        <div class="rooms-container">
            <!-- Kamar Standar -->
            <a href="{{ route('pemesanan.create', ['tipe' => 'Standar']) }}" class="room-card"
                style="text-decoration: none; color: inherit; display: block;">
                <div>
                    <div class="room-image-wrapper">
                        <div class="booking-overlay">
                            <span class="booking-overlay-btn">Pilih Kamar</span>
                        </div>
                        <img src="{{ asset('image/kamar 1.jpeg') }}" alt="Kamar Standard">
                    </div>
                    <div class="room-header">
                        <h3 class="room-title">Standar</h3>
                        <div class="room-price">Rp 1.850.000 <span>/malam</span></div>
                    </div>
                    <p class="room-subtitle">Tenang, Bersih, Damai, Modern,...</p>
                </div>
                <div class="room-details">
                    <div class="detail-item">Kasur: <strong>1</strong></div>
                    <div class="detail-divider"></div>
                    <div class="detail-item">Kamar Mandi: <strong>1</strong></div>
                    <div class="detail-divider"></div>
                    <div class="detail-item">Luas: <strong>60 m²</strong></div>
                </div>
            </a>

            <!-- Kamar Deluxe -->
            <a href="{{ route('pemesanan.create', ['tipe' => 'Deluxe']) }}" class="room-card"
                style="text-decoration: none; color: inherit; display: block;">
                <div>
                    <div class="room-image-wrapper">
                        <div class="booking-overlay">
                            <span class="booking-overlay-btn">Pilih Kamar</span>
                        </div>
                        <img src="{{ asset('image/kamar 2.jpeg') }}" alt="Kamar Deluxe">
                    </div>
                    <div class="room-header">
                        <h3 class="room-title">Deluxe</h3>
                        <div class="room-price">Rp 2.450.000 <span>/malam</span></div>
                    </div>
                    <p class="room-subtitle">Tenang, Bersih, Damai, Modern,...</p>
                </div>
                <div class="room-details">
                    <div class="detail-item">Kasur: <strong>2</strong></div>
                    <div class="detail-divider"></div>
                    <div class="detail-item">Kamar Mandi: <strong>2</strong></div>
                    <div class="detail-divider"></div>
                    <div class="detail-item">Luas: <strong>85 m²</strong></div>
                </div>
            </a>

            <!-- Kamar Executive -->
            <a href="{{ route('pemesanan.create', ['tipe' => 'Executive']) }}" class="room-card"
                style="text-decoration: none; color: inherit; display: block;">
                <div>
                    <div class="room-image-wrapper">
                        <div class="booking-overlay">
                            <span class="booking-overlay-btn">Pilih Kamar</span>
                        </div>
                        <img src="{{ asset('image/kamar 3.png') }}" alt="Kamar Executive">
                    </div>
                    <div class="room-header">
                        <h3 class="room-title">Executive</h3>
                        <div class="room-price">Rp 3.679.000 <span>/malam</span></div>
                    </div>
                    <p class="room-subtitle">Tenang, Bersih, Damai, Modern,...</p>
                </div>
                <div class="room-details">
                    <div class="detail-item">Kasur: <strong>2</strong></div>
                    <div class="detail-divider"></div>
                    <div class="detail-item">Kamar Mandi: <strong>2</strong></div>
                    <div class="detail-divider"></div>
                    <div class="detail-item">Luas: <strong>105 m²</strong></div>
                </div>
            </a>
        </div>
    </section>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-brand" style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <img src="{{ asset('image/LogoSoleia2.png') }}" alt="Logo Soleia Hotel" class="image"
                    style="height: 50px; width: auto; object-fit: contain;">
                <div>
                    <h3>Soleia Hotel</h3>
                    <p>Kemewahan & Tempat Peristirahatan</p>
                </div>
            </div>

            <div class="footer-content">
                <div class="footer-block address">
                    <div class="footer-label">Lokasi</div>
                    <p>
                        Jl. Raya Nusa Dua Selatan No. 88<br>
                        Kuta Selatan, Badung, Bali 80363<br>
                        Indonesia
                    </p>
                </div>

                <div class="footer-block links">
                    <div class="footer-label">Hubungi Kami</div>
                    <div class="footer-socials">
                        <a href="https://soleiaresort.com" target="_blank">www.soleiahotel.com</a>
                        <a href="https://wa.me/6281234567890" target="_blank">WhatsApp: +62 812-3456-7890</a>
                        <a href="https://instagram.com" target="_blank">Instagram: @soleiahotel</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Soleia Hotel. Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

</body>

</html>