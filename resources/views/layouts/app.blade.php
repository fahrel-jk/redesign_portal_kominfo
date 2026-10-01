<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Portal Layanan | Kominfo Jawa Timur</title>

  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">

  
  <script src="https://unpkg.com/lucide@latest"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  
  <a href="#main-content"
    class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white text-primary px-4 py-2 z-50 rounded-md shadow-lg">
    Lewati ke konten utama
  </a>


  

  <header class="site-header" id="siteHeader">

    <div class="header-inner">

      <nav class="navbar">

        <a href="{{ route('portal.home') }}" class="brand">
          <div class="brand-logo">
            <img src="{{ asset('images/logo_kominfo_text_white.png') }}" alt="Logo Diskominfo Jawa Timur" class="brand-logo-img">
          </div>
          <div class="brand-text">
            <strong>KOMINFO</strong>
            <span>JAWA TIMUR</span>
          </div>
        </a>

        <div class="nav-links">
          <a href="#beranda" class="nav-link active">Beranda</a>
          <a href="#layanan" class="nav-link">Layanan</a>
          <a href="#berita" class="nav-link">Berita</a>
          <a href="#kegiatan" class="nav-link">Kegiatan</a>
          <a href="#galeri" class="nav-link">Galeri</a>
        </div>

        <div class="nav-actions">
          <a href="https://kominfo.jatimprov.go.id" class="nav-site-link" target="_blank" rel="noopener">
            <i data-lucide="external-link"></i>
            <span>Website Utama</span>
          </a>
        </div>

        <button class="mobile-menu-button" id="mobileMenuButton" aria-label="Buka menu">
          <i data-lucide="menu"></i>
        </button>

      </nav>

      
      <div class="mobile-menu" id="mobileMenu">
        <a href="#beranda">Beranda</a>
        <a href="#layanan">Layanan</a>
        <a href="#berita">Berita</a>
        <a href="#kegiatan">Kegiatan</a>
        <a href="#galeri">Galeri</a>
        <a href="https://kominfo.jatimprov.go.id" target="_blank" rel="noopener">Website Utama ↗</a>
      </div>

    </div>

  </header>

  <main id="main-content">
    @yield('content')
  </main>

  

  <footer class="site-footer">

    <div class="container">

      <div class="footer-grid-tangsel">

        
        <div class="footer-col footer-col-address">
          <h4><i data-lucide="map-pin"></i> Kantor Kominfo Jawa Timur</h4>
          <p class="footer-address-text">
            Jl. Ahmad Yani No. 242-244, Gayungan, Kec. Gayungan,<br>
            Kota Surabaya, Jawa Timur 60235
          </p>

          <div class="footer-map-card">
            <div class="map-iframe-container">
              <iframe title="Peta Lokasi Kantor Dinas Komunikasi dan Informatika Provinsi Jawa Timur"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.253664797072!2d112.7297379758778!3d-7.325381372036735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb6d10c73449%3A0x62a563ee9a37651c!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
              <div class="map-overlay-badge">
                <i data-lucide="map-pin"></i>
                <span>Diskominfo Jatim</span>
              </div>
            </div>
            <a href="https://maps.google.com/?q=Dinas+Komunikasi+dan+Informatika+Provinsi+Jawa+Timur" target="_blank"
              rel="noopener" class="map-link-btn">
              <span>Maps</span>
              <i data-lucide="external-link"></i>
            </a>
          </div>
        </div>

        
        <div class="footer-col footer-col-info">
          <h4>Pusat Informasi Lain</h4>
          <ul class="footer-social-list">
            <li>
              <a href="https://instagram.com/kominfojatim" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                  <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                </svg>
                <span>@kominfojatim</span>
              </a>
            </li>
            <li>
              <a href="https://tiktok.com/@kominfojatim" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" />
                </svg>
                <span>@kominfojatim</span>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/humasjatim" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 4s-.7.2-1.5.3a4.7 4.7 0 0 0-7.7 4.3c-3.9-.2-7.4-2.1-9.7-5a4.7 4.7 0 0 0 1.4 6.3c-.7 0-1.4-.2-2-.5 0 2.2 1.6 4.1 3.7 4.5-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 1.8 2.3 3.2 4.3 3.3a9.5 9.5 0 0 1-7.1 2c2.1 1.3 4.6 2.1 7.2 2.1 8.7 0 13.5-7.2 13.5-13.5v-.6c.9-.7 1.7-1.6 2.3-2.6z"/>
                </svg>
                <span>@humasjatim</span>
              </a>
            </li>
            <li>
              <a href="https://facebook.com/HumasKominfoJatim" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                </svg>
                <span>Humas Kominfo Jatim</span>
              </a>
            </li>
            <li>
              <a href="https://youtube.com/KominfoJatim" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.56 49.56 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                  <polygon points="10 15 15 12 10 9 10 15"/>
                </svg>
                <span>Kominfo Jatim Official</span>
              </a>
            </li>
          </ul>
        </div>

        
        <div class="footer-col footer-col-stats">
          <h4>Statistik Pengunjung</h4>
          <div class="visitor-stats-list">
            <div class="stat-row">
              <span class="stat-label"><i data-lucide="calendar"></i> Hari Ini</span>
              <span class="stat-value">1.420</span>
            </div>

            <div class="stat-row">
              <span class="stat-label"><i data-lucide="history"></i> Kemarin</span>
              <span class="stat-value">3.850</span>
            </div>

            <div class="stat-row">
              <span class="stat-label"><i data-lucide="calendar-days"></i> Bulan Ini</span>
              <span class="stat-value">45.290</span>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="footer-bottom">
      <div class="container">
        <p>&copy; {{ date('Y') }} Dinas Komunikasi dan Informatika Provinsi Jawa Timur. Hak Cipta Dilindungi.</p>
      </div>
    </div>

  </footer>

  
  <button id="backToTop" aria-label="Kembali ke atas" class="back-to-top">
    <i data-lucide="arrow-up"></i>
  </button>

</body>

</html>
