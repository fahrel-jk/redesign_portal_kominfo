@extends('layouts.app')

@section('content')
<script>
    window.laravelServices = @json($services);
    window.laravelCategories = @json($categories);
    window.laravelEvents = @json($events);
    window.laravelGalleries = @json($galleries);
    window.laravelVideos = @json($videos);
</script>



<section class="hero-section" id="beranda">

  
  <div class="hero-scene" id="scene-root">
    
    <div class="sun-system-anchor">
      <div class="sun-rays"></div>
      <div class="sun-core"></div>
    </div>

    
    <div class="city-layer" id="layer-far">
      <svg viewBox="0 0 1920 720" preserveAspectRatio="xMidYMax meet"></svg>
    </div>

    
    <div class="city-layer" id="layer-mid">
      <svg viewBox="0 0 1920 720" preserveAspectRatio="xMidYMax meet">
        <defs>
          <pattern id="ledGridPattern" width="4" height="4" patternUnits="userSpaceOnUse">
            <rect width="4" height="4" fill="#0b5e57" />
            <circle cx="2" cy="2" r="0.9" fill="#2dd4bf" opacity="0.45" />
          </pattern>
          <linearGradient id="rotundaGlass" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.95" />
            <stop offset="50%" stop-color="#bae6fd" stop-opacity="0.9" />
            <stop offset="100%" stop-color="#0284c7" stop-opacity="0.95" />
          </linearGradient>
        </defs>
      </svg>
    </div>

    
    <div class="city-layer" id="layer-fore">
      <svg viewBox="0 0 1920 720" preserveAspectRatio="xMidYMax meet"></svg>
    </div>
  </div>
  

  
  <div class="hero-overlay">

    <div class="hero-container">

      
      <div class="hero-content">

        <div class="hero-content-inner">

          <h1>
            Memenuhi Kebutuhan<br>
            Layanan Digital<br>
            <span>Jawa Timur</span>
          </h1>

          <p class="hero-description">
            Akses berbagai layanan digital Dinas Komunikasi
            dan Informatika Provinsi Jawa Timur
            dengan mudah dan cepat.
          </p>

          
          <div class="search-wrapper">
            <div class="search-box">
              <i data-lucide="search"></i>
              <input type="text" id="serviceSearch" placeholder="Cari layanan digital..." autocomplete="off">
              <button class="search-button" id="searchButton">Cari</button>
            </div>
          </div>

          <div class="search-suggestions" id="searchSuggestions">
            <span>Pencarian populer:</span>
            <button data-search="SIMA">SIMA</button>
            <button data-search="Data">Data Jatim</button>
            <button data-search="Pengaduan">Pengaduan</button>
            <button data-search="Informasi">Informasi Publik</button>
          </div>

          
          <div class="hero-socials">
            <a href="https://facebook.com/HumasKominfoJatim" target="_blank" aria-label="Facebook" title="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
              </svg>
            </a>
            <a href="https://instagram.com/kominfojatim" target="_blank" aria-label="Instagram" title="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
              </svg>
            </a>
            <a href="https://tiktok.com/@kominfojatim" target="_blank" aria-label="TikTok" title="TikTok">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" />
              </svg>
            </a>
            <a href="https://youtube.com/KominfoJatim" target="_blank" aria-label="Youtube" title="Youtube">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.56 49.56 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                <polygon points="10 15 15 12 10 9 10 15"/>
              </svg>
            </a>
          </div>

        </div>

      </div>

      
      <div class="hero-info">

        <div class="glass-panel glass-panel-info">

          
          <div class="info-location">
            <div class="info-location-icon">
              <i data-lucide="map-pin"></i>
            </div>
            <div class="info-location-text">
              <strong>Surabaya</strong>
              <span id="currentDate">Hari Ini • {{ date('d F Y') }}</span>
            </div>
          </div>

          
          <div class="info-weather">
            <div class="weather-icon">
              <svg viewBox="0 0 64 64" width="70" height="70">
                <circle cx="32" cy="28" r="10" fill="#fbbf24" />
                <g stroke="#fbbf24" stroke-width="2.5" stroke-linecap="round">
                  <line x1="32" y1="10" x2="32" y2="14" />
                  <line x1="32" y1="42" x2="32" y2="46" />
                  <line x1="14" y1="28" x2="18" y2="28" />
                  <line x1="46" y1="28" x2="50" y2="28" />
                  <line x1="19.3" y1="15.3" x2="22.1" y2="18.1" />
                  <line x1="41.9" y1="37.9" x2="44.7" y2="40.7" />
                  <line x1="19.3" y1="40.7" x2="22.1" y2="37.9" />
                  <line x1="41.9" y1="18.1" x2="44.7" y2="15.3" />
                </g>
                <path d="M44 40 Q44 34 38 34 Q37 28 30 28 Q23 28 22 34 Q18 34 18 40 Z"
                  fill="rgba(255,255,255,0.9)" />
              </svg>
            </div>
            <div class="weather-temp">
              <span class="temp-value" id="tempValue">33</span>
              <span class="temp-unit">°</span>
            </div>
          </div>

          <div class="weather-desc" id="weatherDesc">Cerah Berawan</div>

          
          <div class="weather-details">
            <div class="weather-detail">
              <div class="weather-detail-icon">
                <i data-lucide="droplets"></i>
              </div>
              <div class="weather-detail-text">
                <span>Kelembapan</span>
                <strong id="humidityValue">52%</strong>
              </div>
            </div>

            <div class="weather-detail">
              <div class="weather-detail-icon">
                <i data-lucide="wind"></i>
              </div>
              <div class="weather-detail-text">
                <span>Kec. Angin</span>
                <strong id="windValue">14 km/h</strong>
              </div>
            </div>

            <div class="weather-detail">
              <div class="weather-detail-icon">
                <i data-lucide="compass"></i>
              </div>
              <div class="weather-detail-text">
                <span>Arah Angin</span>
                <strong id="windDir">Timur</strong>
              </div>
            </div>
          </div>

        </div>

        
        <div class="glass-panel glass-panel-stats">
          <div class="hero-stat">
            <strong id="serviceCount">{{ $totalServicesCount }}+</strong>
            <span>Layanan Digital</span>
          </div>
          <div class="stat-divider"></div>
          <div class="hero-stat">
            <strong>{{ $totalCategoriesCount }}</strong>
            <span>Kategori</span>
          </div>
          <div class="stat-divider"></div>
          <div class="hero-stat">
            <strong>24/7</strong>
            <span>Akses Portal</span>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>




<section class="services-section combined-services-section" id="layanan">
  <div id="kategori"></div>

  <div class="container">

    <div class="services-header">
      <div>
        <span class="section-eyebrow">DIREKTORI & KATEGORI LAYANAN</span>
        <h2>Temukan Layanan Digital Jawa Timur</h2>
      </div>
      <div class="result-count">
        <span id="resultCount">{{ count($services) }}</span>
        layanan tersedia
      </div>
    </div>

    
    <div class="category-list" id="categoryList">
      <button class="category-chip active" data-category="all">
        <i data-lucide="grid-2x2"></i>
        Semua Layanan
      </button>
      @foreach($categories as $category)
      <button class="category-chip" data-category="{{ $category->slug }}">
        @if($category->icon)
          <i data-lucide="{{ $category->icon }}"></i>
        @else
          <i data-lucide="folder"></i>
        @endif
        {{ $category->name }}
      </button>
      @endforeach
    </div>

    
    <div class="search-result-info" id="searchResultInfo">
      <span>
        Hasil pencarian untuk
        <strong id="searchKeyword"></strong>
      </span>
      <button id="clearSearch">Hapus pencarian</button>
    </div>

    <div class="services-grid" id="servicesGrid">
      @foreach($services as $service)
      <article class="service-card">
        <div class="service-icon">
          <img src="{{ asset('images/logo_jatim.webp') }}" alt="{{ $service->name }}">
        </div>
        <div class="service-card-info">
          <h3>{{ $service->name }}</h3>
          <p>{{ $service->description }}</p>
          <span class="service-access">
            <i data-lucide="check-circle-2"></i>
            {{ $service->access_type === 'path' ? 'Terintegrasi (Path Domain Utama)' : 'Layanan Domain Eksternal' }}
          </span>
        </div>
        <a href="{{ $service->public_url }}" target="{{ $service->access_type === 'domain' ? '_blank' : '_self' }}" rel="noopener" aria-label="Buka {{ $service->name }}">
          <i data-lucide="arrow-up-right"></i>
        </a>
      </article>
      @endforeach
    </div>

    <div class="empty-state" id="emptyState">
      <div class="empty-icon">
        <i data-lucide="search-x"></i>
      </div>
      <h3>Layanan tidak ditemukan</h3>
      <p>
        Coba gunakan kata kunci lain atau pilih
        kategori yang berbeda.
      </p>
      <button id="resetFilters">Tampilkan Semua Layanan</button>
    </div>

  </div>

</section>



<section class="news-section" id="berita">

  <div class="container">

    <div class="section-heading">
      <div>
        <span class="section-eyebrow">BERITA & KABAR</span>
        <h2>Informasi Terkini Jawa Timur</h2>
      </div>
      <div class="news-filter" id="newsFilter">
        <button class="news-tab active" data-filter="all">Semua</button>
        <button class="news-tab" data-filter="pemerintahan">Pemerintahan</button>
        <button class="news-tab" data-filter="digital">Digitalisasi</button>
        <button class="news-tab" data-filter="pengumuman">Pengumuman</button>
      </div>
    </div>

    <div class="news-grid">

      @if($news->isNotEmpty())
      {{-- Featured News Item (first item) --}}
      @php $featured = $news->first(); @endphp
      <article class="news-card news-featured" data-category="{{ strtolower($featured->category) }}">
        <div class="news-thumb">
          <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" loading="lazy">
          <span class="news-badge">{{ $featured->category }}</span>
        </div>
        <div class="news-body">
          <div class="news-meta">
            <span><i data-lucide="calendar"></i> {{ $featured->published_at?->translatedFormat('d F Y') ?? $featured->created_at->translatedFormat('d F Y') }}</span>
            <span><i data-lucide="clock"></i> {{ $featured->read_time ?? '3 min baca' }}</span>
          </div>
          <h3>{{ $featured->title }}</h3>
          <p>{{ $featured->summary }}</p>
          <span class="news-read-more">
            Baca Selengkapnya
            <i data-lucide="arrow-right"></i>
          </span>
        </div>
      </article>

      {{-- Side News Column (remaining items) --}}
      <div class="news-side-column">
        @foreach($news->skip(1) as $item)
        <article class="news-card news-mini" data-category="{{ strtolower($item->category) }}">
          <div class="news-mini-thumb">
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
          </div>
          <div class="news-mini-content">
            <span class="news-badge-sm">{{ $item->category }}</span>
            <h4>{{ $item->title }}</h4>
            <span class="news-date"><i data-lucide="calendar"></i> {{ $item->published_at?->translatedFormat('d M Y') ?? $item->created_at->translatedFormat('d M Y') }}</span>
          </div>
        </article>
        @endforeach
      </div>
      @else
      <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: #64748b;">
        <i data-lucide="newspaper" style="width: 40px; height: 40px; margin-bottom: 12px; color: #cbd5e1;"></i>
        <p>Belum ada berita tersedia.</p>
      </div>
      @endif

    </div>

  </div>

</section>




<section class="calendar-section" id="kegiatan">

  <div class="container">

    <div class="calendar-wrapper-card">

      <div class="calendar-header-title">
        <h2><i data-lucide="calendar" class="calendar-icon-header"></i> Kalender Kegiatan</h2>
      </div>

      <div class="calendar-grid-container">

        
        <div class="event-poster-card" id="eventPosterCard">
          @if($events->isNotEmpty())
          @php $firstEvent = $events->first(); @endphp
          <div class="poster-image-wrapper">
            <img src="{{ $firstEvent->image_url }}" id="eventImage" alt="{{ $firstEvent->title }}" loading="lazy">
            <div class="poster-badge" id="eventDateBadge">
              <span class="month">{{ $firstEvent->event_date?->translatedFormat('M') ?? '-' }}</span>
              <span class="day">{{ $firstEvent->event_date?->format('d') ?? '-' }}</span>
            </div>
          </div>

          <div class="poster-info tangsel-gold-card">
            <div>
              <h3 id="eventName">{{ $firstEvent->title }}</h3>

              <div class="event-details-list">
                <div class="event-detail-item">
                  <i data-lucide="clipboard-list"></i>
                  <div>
                    <strong>Nama Event</strong>
                    <span id="eventTagText">{{ $firstEvent->tag }}</span>
                  </div>
                </div>

                <div class="event-detail-item">
                  <i data-lucide="clock"></i>
                  <div>
                    <strong>Pelaksanaan</strong>
                    <span id="eventDate">{{ $firstEvent->date_label ?? $firstEvent->event_date?->translatedFormat('d M Y') }}</span>
                  </div>
                </div>
              </div>
            </div>

            <span class="event-cta-btn tangsel-blue-btn">
              <i data-lucide="info"></i>
              <span>Lihat Detail</span>
            </span>

          </div>
          @else
          <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; padding: 48px 24px; text-align: center; color: #64748b;">
            <i data-lucide="calendar-off" style="width: 40px; height: 40px; margin-bottom: 12px; color: #cbd5e1;"></i>
            <p>Belum ada kegiatan terdaftar.</p>
          </div>
          @endif
        </div>


        
        <div class="calendar-widget liquid-glass-calendar">

          <div class="calendar-header-top">
            <span class="cal-today-badge">{{ now()->translatedFormat('l, d M Y') }}</span>
            <div class="calendar-nav">
              <h3 class="cal-month-title" id="calendarMonth">{{ now()->translatedFormat('F Y') }}</h3>
              <div class="cal-nav-controls">
                <button class="cal-nav-btn" id="prevMonth" aria-label="Bulan sebelumnya"><i
                    data-lucide="chevron-left"></i></button>
                <button class="cal-nav-btn" id="nextMonth" aria-label="Bulan berikutnya"><i
                    data-lucide="chevron-right"></i></button>
              </div>
            </div>
          </div>

          <div class="calendar-table">
            <div class="cal-days-header-row">
              <div>Sen</div>
              <div>Sel</div>
              <div>Rab</div>
              <div>Kam</div>
              <div>Jum</div>
              <div>Sab</div>
              <div>Min</div>
            </div>

            
            <div class="cal-days-grid" id="calendarDaysGrid"></div>
          </div>

          <div class="calendar-legend">
            <span class="legend-item"><span class="dot event-dot"></span> Ada Kegiatan</span>
            <span class="legend-item"><span class="dot active-dot"></span> Dipilih</span>
          </div>

        </div>

      </div>

    </div>

  </div>

</section>




<section class="video-section" id="video">

  <div class="container">

    <div class="section-heading">
      <div>
        <span class="section-eyebrow">VIDEO & KONTEN</span>
        <h2>Video Seputar Jawa Timur</h2>
      </div>
      <a href="https://youtube.com/@KominfoJatim" target="_blank" rel="noopener" class="video-selengkapnya-btn">
        Selengkapnya
        <i data-lucide="arrow-right"></i>
      </a>
    </div>

    <div class="video-grid">

      @if($videos->isNotEmpty())
      @php $featuredVideo = $videos->first(); @endphp
      
      <div class="video-featured" id="videoFeatured">
        <div class="video-player-wrapper">
          <iframe
            id="videoPlayerIframe"
            src="{{ $featuredVideo->embed_url ?: 'https://www.youtube.com/embed/live_stream?channel=UCexXiy50wMTigMYnMFrNe3A' }}"
            title="{{ $featuredVideo->title }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
            loading="lazy"
          ></iframe>
        </div>

        <div class="video-featured-info">
          <h3 id="videoFeaturedTitle">{{ $featuredVideo->title }}</h3>
          <div class="video-featured-meta">
            <span><i data-lucide="calendar"></i> <span id="videoFeaturedDate">{{ $featuredVideo->published_at?->translatedFormat('d F Y') ?? $featuredVideo->created_at->translatedFormat('d F Y') }}</span></span>
            <span class="video-category-badge" id="videoFeaturedCategory">{{ $featuredVideo->category }}</span>
          </div>
          <p id="videoFeaturedDesc">{{ $featuredVideo->description }}</p>
        </div>
      </div>

      
      <div class="video-sidebar">
        <h4 class="video-sidebar-title">
          <i data-lucide="list-video"></i>
          Video Lainnya
        </h4>

        <div class="video-sidebar-list" id="videoSidebarList">
          @foreach($videos->skip(1) as $item)
          <a href="#" class="video-sidebar-item" data-embed-url="{{ $item->embed_url }}" data-title="{{ $item->title }}" data-date="{{ $item->published_at?->translatedFormat('d F Y') ?? $item->created_at->translatedFormat('d F Y') }}" data-category="{{ $item->category }}" data-desc="{{ $item->description }}" onclick="playVideoItem(event, this)">
            <div class="video-sidebar-thumb">
              <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" loading="lazy">
              <span class="video-play-icon"><i data-lucide="play"></i></span>
            </div>
            <div class="video-sidebar-content">
              <h5>{{ $item->title }}</h5>
              <div class="video-sidebar-meta">
                <span>{{ $item->published_at?->format('d-m-Y, H:i') ?? $item->created_at->format('d-m-Y, H:i') }}</span>
                <span class="video-tag">{{ $item->category }}</span>
              </div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @else
      <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: #64748b;">
        <i data-lucide="video-off" style="width: 40px; height: 40px; margin-bottom: 12px; color: #cbd5e1;"></i>
        <p>Belum ada video YouTube tersedia.</p>
      </div>
      @endif

    </div>

  </div>

</section>




<section class="gallery-section" id="galeri">

  <div class="container">

    <div class="section-heading">
      <div>
        <span class="section-eyebrow">DOKUMENTASI</span>
        <h2>Galeri Foto Kegiatan</h2>
      </div>
    </div>

    @if($galleries->isNotEmpty())
    
    <div class="gallery-carousel-wrapper">

      <button class="carousel-nav carousel-prev" id="galleryPrev" aria-label="Foto sebelumnya">
        <i data-lucide="chevron-left"></i>
      </button>

      <div class="gallery-track-viewport">
        <div class="gallery-carousel-track" id="galleryTrack">
          @foreach($galleries as $index => $gallery)
          <div class="gallery-card {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
            <div class="gallery-card-inner">
              <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" loading="lazy">
              <div class="gallery-card-overlay">
                <span class="gallery-tag">{{ strtoupper($gallery->tag) }}</span>
                <span class="gallery-date">{{ $gallery->event_datetime?->format('d-m-Y \u2022 H:i') ?? '-' }}</span>
                <h3>{{ $gallery->title }}</h3>
                <p>{{ $gallery->description }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <button class="carousel-nav carousel-next" id="galleryNext" aria-label="Foto berikutnya">
        <i data-lucide="chevron-right"></i>
      </button>

    </div>

    
    <div class="gallery-dots" id="galleryDots">
      @foreach($galleries as $index => $gallery)
      <span class="dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
      @endforeach
    </div>
    @else
    <div style="text-align: center; padding: 48px 0; color: #64748b;">
      <i data-lucide="image-off" style="width: 40px; height: 40px; margin-bottom: 12px; color: #cbd5e1;"></i>
      <p>Belum ada foto galeri tersedia.</p>
    </div>
    @endif

  </div>

</section>

<script>
function playVideoItem(e, el) {
  e.preventDefault();
  const embedUrl = el.dataset.embedUrl;
  const title = el.dataset.title;
  const date = el.dataset.date;
  const category = el.dataset.category;
  const desc = el.dataset.desc;

  const iframe = document.getElementById('videoPlayerIframe');
  const titleEl = document.getElementById('videoFeaturedTitle');
  const dateEl = document.getElementById('videoFeaturedDate');
  const catEl = document.getElementById('videoFeaturedCategory');
  const descEl = document.getElementById('videoFeaturedDesc');

  if (iframe && embedUrl) iframe.src = embedUrl;
  if (titleEl && title) titleEl.textContent = title;
  if (dateEl && date) dateEl.textContent = date;
  if (catEl && category) catEl.textContent = category;
  if (descEl && desc) descEl.textContent = desc;
}
</script>

@endsection

