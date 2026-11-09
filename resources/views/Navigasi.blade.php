<!-- FLOATING PILL NAVBAR -->
<div style="position: fixed; top: 20px; left: 0; right: 0; z-index: 9999; display: flex; justify-content: center; pointer-events: none;">
    <div style="pointer-events: auto; background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid rgba(231, 229, 228, 0.8); border-radius: 9999px; padding: 5px; display: flex; gap: 6px; align-items: center; font-family: 'Montserrat', sans-serif;">
        
        <!-- Logo di sebelah kiri menu Home -->
        <div style="padding-left: 8px; display: flex; align-items: center;">
            <img src="{{ asset('image/LogoSoleia.png') }}" alt="Logo Soleia" class="image" style="height: 24px; width: auto; object-fit: contain;">
        </div>

        <!-- Menu 1: Home -->
        <a href="{{ route('home') }}" 
           style="{{ Request::routeIs('home') ? 'background-color: #16291c; color: white;' : 'color: #44403c;' }} padding: 10px 22px; border-radius: 9999px; font-size: 12px; font-weight: 400; text-decoration: none; transition: all 0.3s ease; display: inline-block; text-align: center; font-family: 'Montserrat', sans-serif;">
            Beranda
        </a>

        <!-- Menu 2: Pesanan (Rincian Pesanan) -->
        <a href="{{ route('pemesanan.index') }}" 
           style="{{ Request::routeIs('pemesanan.index') ? 'background-color: #16291c; color: white;' : 'color: #44403c;' }} padding: 10px 22px; border-radius: 9999px; font-size: 12px; font-weight: 400; text-decoration: none; transition: all 0.3s ease; display: inline-block; text-align: center; font-family: 'Montserrat', sans-serif;">
            Pesanan
        </a>

    </div>
</div>