




const defaultServices = [
  {
    id: 1,
    name: "SIMA",
    category: "teknologi",
    categoryName: "Teknologi Informasi",
    description: "Sistem informasi untuk mendukung pengelolaan layanan digital Kominfo Jawa Timur.",
    icon: "monitor",
    featured: true,
    accessType: "domain",
    url: "https://sima.kominfo.jatimprov.go.id"
  },
  {
    id: 2,
    name: "SIKIPO",
    category: "pemerintahan",
    categoryName: "Pemerintahan",
    description: "Layanan digital untuk mendukung kebutuhan administrasi dan pemerintahan.",
    icon: "landmark",
    featured: true,
    accessType: "domain",
    url: "#"
  },
  {
    id: 3,
    name: "Data Jawa Timur",
    category: "data",
    categoryName: "Data & Statistik",
    description: "Akses informasi dan data yang berkaitan dengan Provinsi Jawa Timur.",
    icon: "database",
    featured: true,
    accessType: "path",
    path: "/data"
  },
  {
    id: 4,
    name: "Informasi Publik",
    category: "informasi",
    categoryName: "Informasi Publik",
    description: "Informasi publik dan berbagai dokumen yang dapat diakses masyarakat.",
    icon: "file-text",
    featured: false,
    accessType: "path",
    path: "/informasi-publik"
  }
];

function getServicesData() {
  if (Array.isArray(window.laravelServices) && window.laravelServices.length > 0) {
    return window.laravelServices.map(s => ({
      id: s.id,
      name: s.name,
      category: s.category ? s.category.slug : '',
      categoryName: s.category ? s.category.name : '',
      description: s.description || '',
      icon: s.icon || 'globe',
      featured: false,
      accessType: s.access_type,
      url: s.url,
      path: s.path,
      publicUrl: s.public_url
    }));
  }
  return defaultServices;
}




const servicesGrid =
  document.getElementById("servicesGrid");

const featuredServices =
  document.getElementById("featuredServices");

const serviceSearch =
  document.getElementById("serviceSearch");

const searchButton =
  document.getElementById("searchButton");

const categoryList =
  document.getElementById("categoryList");

const resultCount =
  document.getElementById("resultCount");

const serviceCount =
  document.getElementById("serviceCount");

const emptyState =
  document.getElementById("emptyState");

const searchResultInfo =
  document.getElementById("searchResultInfo");

const searchKeyword =
  document.getElementById("searchKeyword");

const clearSearch =
  document.getElementById("clearSearch");

const resetFilters =
  document.getElementById("resetFilters");

const backToTop =
  document.getElementById("backToTop");

const mobileMenuButton =
  document.getElementById("mobileMenuButton");

const mobileMenu =
  document.getElementById("mobileMenu");

const siteHeader =
  document.getElementById("siteHeader");




let activeCategory = "all";
let searchQuery = "";




document.addEventListener(
  "DOMContentLoaded",
  () => {
    initHeroAnimation();
    renderServices();
    updateServiceCount();
    initializeIcons();
    updateDateTime();
    initNewsFilter();
    initCalendarWidget();
    initGalleryCarousel();
  }
);




function initializeIcons() {
  if (typeof lucide !== "undefined") {
    lucide.createIcons();
  }
}




function updateDateTime() {

  const currentDate =
    document.getElementById("currentDate");

  if (!currentDate) return;

  const now = new Date();

  const days = [
    "Minggu", "Senin", "Selasa", "Rabu",
    "Kamis", "Jumat", "Sabtu"
  ];

  const months = [
    "Januari", "Februari", "Maret", "April",
    "Mei", "Juni", "Juli", "Agustus",
    "September", "Oktober", "November", "Desember"
  ];

  const dayName = days[now.getDay()];
  const date = now.getDate();
  const month = months[now.getMonth()];
  const year = now.getFullYear();

  currentDate.textContent =
    `${dayName} • ${date} ${month} ${year}`;

}




function getServiceUrl(service) {
  if (service.accessType === "path") {
    return service.path;
  }
  return service.url || "#";
}




function createServiceCard(
  service,
  featured = false
) {

  const url = getServiceUrl(service);

  if (featured) {
    return `

            <article class="featured-card">

                <div>

                    <div class="service-icon">
                        <img src="/images/logo_jatim.webp" alt="${service.name}">
                    </div>

                    <div class="service-card-content">
                        <h3>${service.name}</h3>
                        <p>${service.description}</p>
                    </div>

                </div>

                <div class="service-card-meta">

                    <span class="service-category-label">
                        ${service.categoryName}
                    </span>

                    <a
                        href="${url}"
                        class="service-arrow"
                        aria-label="Buka ${service.name}"
                    >
                        <i data-lucide="arrow-up-right"></i>
                    </a>

                </div>

            </article>

        `;
  }


  return `

        <article class="service-card">

            <div class="service-icon">
                <img src="/images/logo_jatim.webp" alt="${service.name}">
            </div>

            <div class="service-card-info">

                <h3>${service.name}</h3>

                <p>${service.description}</p>

                <span class="service-access">
                    <i data-lucide="check-circle-2"></i>
                    ${service.accessType === "path"
      ? "Terintegrasi"
      : "Layanan eksternal"
    }
                </span>

            </div>

            <a
                href="${url}"
                aria-label="Buka ${service.name}"
            >
                <i data-lucide="arrow-up-right"></i>
            </a>

        </article>

    `;

}




function renderFeaturedServices() {
  if (!featuredServices) return;

  const featured =
    services.filter(
      service => service.featured
    );

  featuredServices.innerHTML =
    featured
      .map(
        service =>
          createServiceCard(service, true)
      )
      .join("");

  initializeIcons();
}




function getFilteredServices() {

  return getServicesData().filter(
    service => {

      const matchesCategory =
        activeCategory === "all" ||
        service.category === activeCategory;

      const searchableText =
        `${service.name} ${service.description} ${service.categoryName}`
          .toLowerCase();

      const matchesSearch =
        !searchQuery ||
        searchableText.includes(
          searchQuery.toLowerCase()
        );

      return matchesCategory && matchesSearch;
    }
  );

}




function renderServices() {

  const filteredServices = getFilteredServices();

  resultCount.textContent = filteredServices.length;

  if (filteredServices.length === 0) {
    servicesGrid.innerHTML = "";
    emptyState.classList.add("visible");
  } else {
    emptyState.classList.remove("visible");
    servicesGrid.innerHTML =
      filteredServices
        .map(service => createServiceCard(service))
        .join("");
  }

  updateSearchInfo();
  initializeIcons();
}




function updateSearchInfo() {
  if (searchQuery) {
    searchResultInfo.classList.add("visible");
    searchKeyword.textContent = `"${searchQuery}"`;
  } else {
    searchResultInfo.classList.remove("visible");
  }
}




function performSearch() {

  searchQuery = serviceSearch.value.trim();
  activeCategory = "all";

  updateActiveCategory();
  renderServices();

  if (searchQuery) {
    setTimeout(() => {
      const layananSec = document.getElementById("layanan");
      if (layananSec) layananSec.scrollIntoView({ behavior: "smooth" });
    }, 100);
  }
}




searchButton.addEventListener("click", performSearch);




serviceSearch.addEventListener(
  "keydown",
  event => {
    if (event.key === "Enter") {
      performSearch();
    }
  }
);




document
  .querySelectorAll(".search-suggestions button")
  .forEach(button => {

    button.addEventListener("click", () => {
      const keyword = button.dataset.search;
      serviceSearch.value = keyword;
      performSearch();
    });

  });




categoryList.addEventListener(
  "click",
  event => {

    const button =
      event.target.closest(".category-chip");

    if (!button) return;

    activeCategory = button.dataset.category;
    searchQuery = "";
    serviceSearch.value = "";

    updateActiveCategory();
    renderServices();
  }
);




function updateActiveCategory() {

  document
    .querySelectorAll(".category-chip")
    .forEach(button => {
      button.classList.toggle(
        "active",
        button.dataset.category === activeCategory
      );
    });

}




clearSearch.addEventListener("click", () => {
  searchQuery = "";
  serviceSearch.value = "";
  activeCategory = "all";
  updateActiveCategory();
  renderServices();
});




resetFilters.addEventListener("click", () => {
  searchQuery = "";
  serviceSearch.value = "";
  activeCategory = "all";
  updateActiveCategory();
  renderServices();
});




function updateServiceCount() {
  if (serviceCount) {
    serviceCount.textContent = `${getServicesData().length}+`;
  }
}




mobileMenuButton.addEventListener("click", () => {

  mobileMenu.classList.toggle("open");

  const isOpen =
    mobileMenu.classList.contains("open");

  mobileMenuButton.innerHTML =
    isOpen
      ? `<i data-lucide="x"></i>`
      : `<i data-lucide="menu"></i>`;

  initializeIcons();
});




document
  .querySelectorAll(".mobile-menu a")
  .forEach(link => {

    link.addEventListener("click", () => {
      mobileMenu.classList.remove("open");
      mobileMenuButton.innerHTML =
        `<i data-lucide="menu"></i>`;
      initializeIcons();
    });

  });




const sections =
  document.querySelectorAll("main section[id]");

const navLinks =
  document.querySelectorAll(".nav-link");


window.addEventListener("scroll", () => {

  let currentSection = "";

  sections.forEach(section => {
    const sectionTop = section.offsetTop - 180;
    if (window.scrollY >= sectionTop) {
      currentSection = section.getAttribute("id");
    }
  });

  navLinks.forEach(link => {
    link.classList.remove("active");
    const href = link.getAttribute("href");
    if (href === `#${currentSection}`) {
      link.classList.add("active");
    }
  });

});




window.addEventListener("scroll", () => {

  if (window.scrollY > 50) {
    siteHeader.classList.add("scrolled");
  } else {
    siteHeader.classList.remove("scrolled");
  }

});




window.addEventListener("scroll", () => {
  if (window.scrollY > 500) {
    backToTop.classList.add("visible");
  } else {
    backToTop.classList.remove("visible");
  }
});


backToTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});




function initNewsFilter() {
  const newsTabs = document.querySelectorAll(".news-tab");
  const newsCards = document.querySelectorAll(".news-card");

  newsTabs.forEach(tab => {
    tab.addEventListener("click", () => {
      newsTabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");

      const filter = tab.getAttribute("data-filter");

      newsCards.forEach(card => {
        const cat = card.getAttribute("data-category");
        if (filter === "all" || cat === filter) {
          card.style.display = "flex";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
}




const defaultEventsData = {
  22: {
    tag: "Event 1",
    title: "Workshop Cyber Security & CSIRT Pemprov Jatim 2026",
    date: "22 September 2026",
    location: "Ruang Bromo Diskominfo Jatim, Surabaya",
    image: "images/galeri_event_maulid.png",
    month: "Sep",
    day: "22"
  },
  25: {
    tag: "Event 2",
    title: "Pembukaan Jatim Digital Hackathon & Innovation Expo 2026",
    date: "25 September 2026",
    location: "Grand City Convention Center, Surabaya",
    image: "images/event_tech_summit.png",
    month: "Sep",
    day: "25"
  },
  26: {
    tag: "Event 3",
    title: "Pasar Murah Digital & Bazar UMKM Binaan Kominfo",
    date: "26 September 2026",
    location: "Halaman Utama Diskominfo Jatim, Surabaya",
    image: "images/galeri_pasar_murah.png",
    month: "Sep",
    day: "26"
  },
  27: {
    tag: "Event Utama",
    title: "Kejuaraan Sepatu Roda & Marathon Jatim Digital 2026",
    date: "25 September 2026 - 27 September 2026",
    location: "Grand City Convention Hall & Balai Kota Surabaya",
    image: "images/event_tech_summit.png",
    month: "Sep",
    day: "27"
  },
  30: {
    tag: "Event 5",
    title: "Sosialisasi Keterbukaan Informasi Publik PPID Utama",
    date: "30 September 2026",
    location: "Gedung Negara Grahadi, Surabaya",
    image: "images/galeri_event_maulid.png",
    month: "Sep",
    day: "30"
  }
};

function getEventsDataMap() {
  if (Array.isArray(window.laravelEvents) && window.laravelEvents.length > 0) {
    const map = {};
    window.laravelEvents.forEach(evt => {
      if (!evt.event_date) return;
      const dateStr = String(evt.event_date).split('T')[0];
      const parts = dateStr.split('-');
      if (parts.length < 3) return;
      const dayNum = parseInt(parts[2], 10);
      const monthNum = parseInt(parts[1], 10) - 1;
      const yearNum = parts[0];

      const monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
      const fullMonths = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      
      let imgPath = evt.image ? (evt.image.startsWith('http') ? evt.image : '/' + evt.image.replace(/^\//, '')) : '/images/event_tech_summit.png';

      map[dayNum] = {
        tag: evt.tag || 'Kegiatan',
        title: evt.title,
        date: evt.date_label || `${dayNum} ${fullMonths[monthNum]} ${yearNum}`,
        location: evt.location || 'Surabaya',
        image: imgPath,
        month: monthNames[monthNum] || 'Sep',
        day: dayNum
      };
    });
    return map;
  }
  return defaultEventsData;
}

function initCalendarWidget() {
  const daysGrid = document.getElementById("calendarDaysGrid");
  if (!daysGrid) return;

  const eventsMap = getEventsDataMap();

  daysGrid.innerHTML = "";

  // September 2026 starts on Tuesday (index 2 if 1=Mon)
  const emptyCell = document.createElement("div");
  emptyCell.className = "cal-day-cell empty";
  daysGrid.appendChild(emptyCell);

  let activeDay = 27;

  for (let day = 1; day <= 30; day++) {
    const cell = document.createElement("div");
    cell.className = "cal-day-cell";
    cell.textContent = day;

    if (eventsMap[day]) {
      cell.classList.add("has-event");
      if (day === 27 || !eventsMap[activeDay]) {
        activeDay = day;
      }
    }

    if (day === activeDay) {
      cell.classList.add("active-date");
    }

    cell.addEventListener("click", () => {
      document.querySelectorAll(".cal-day-cell").forEach(c => c.classList.remove("active-date"));
      cell.classList.add("active-date");

      if (eventsMap[day]) {
        updateEventPoster(eventsMap[day]);
      } else {
        updateEventPoster({
          tag: `Tanggal ${day} Sep`,
          title: `Agenda Kegiatan Dinas Komunikasi & Informatika (${day} September 2026)`,
          date: `${day} September 2026`,
          location: "Kantor Diskominfo Jatim, Jl. Ahmad Yani 242-244, Surabaya",
          image: "/images/event_tech_summit.png",
          month: "Sep",
          day: day
        });
      }
    });

    daysGrid.appendChild(cell);
  }

  if (eventsMap[activeDay]) {
    updateEventPoster(eventsMap[activeDay]);
  }
}

function updateEventPoster(event) {
  const eventImage = document.getElementById("eventImage");
  const eventDateBadge = document.getElementById("eventDateBadge");
  const eventTagText = document.getElementById("eventTagText");
  const eventName = document.getElementById("eventName");
  const eventDate = document.getElementById("eventDate");

  if (eventImage) eventImage.src = event.image;
  if (eventDateBadge) {
    const m = eventDateBadge.querySelector(".month");
    const d = eventDateBadge.querySelector(".day");
    if (m) m.textContent = event.month || "Sep";
    if (d) d.textContent = event.day || "27";
  }
  if (eventTagText) eventTagText.textContent = event.tag || "Kegiatan";
  if (eventName) eventName.textContent = event.title;
  if (eventDate) eventDate.textContent = event.date;
}




let currentGalleryIndex = 0;

function initGalleryCarousel() {
  const prevBtn = document.getElementById("galleryPrev");
  const nextBtn = document.getElementById("galleryNext");
  const track = document.getElementById("galleryTrack");
  const dots = document.querySelectorAll("#galleryDots .dot");
  const cards = document.querySelectorAll(".gallery-card");

  if (!track || cards.length === 0) return;

  function getVisibleCardsCount() {
    const w = window.innerWidth;
    if (w <= 576) return 1;
    if (w <= 991) return 2;
    return 3;
  }

  function getMaxIndex() {
    const visible = getVisibleCardsCount();
    return Math.max(0, cards.length - visible);
  }

  function updateGalleryView() {
    const maxIndex = getMaxIndex();
    if (currentGalleryIndex > maxIndex) {
      currentGalleryIndex = maxIndex;
    }

    const firstCard = cards[0];
    const cardWidth = firstCard ? firstCard.offsetWidth : 300;
    const gap = 24;
    const offset = currentGalleryIndex * (cardWidth + gap);

    track.style.transform = `translateX(-${offset}px)`;

    cards.forEach((card, idx) => {
      card.classList.toggle("active", idx === currentGalleryIndex);
    });

    dots.forEach((dot, idx) => {
      dot.classList.toggle("active", idx === currentGalleryIndex);
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", () => {
      const maxIndex = getMaxIndex();
      if (currentGalleryIndex > 0) {
        currentGalleryIndex--;
      } else {
        currentGalleryIndex = maxIndex;
      }
      updateGalleryView();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      const maxIndex = getMaxIndex();
      if (currentGalleryIndex < maxIndex) {
        currentGalleryIndex++;
      } else {
        currentGalleryIndex = 0;
      }
      updateGalleryView();
    });
  }

  dots.forEach((dot, idx) => {
    dot.addEventListener("click", () => {
      const maxIndex = getMaxIndex();
      currentGalleryIndex = Math.min(idx, maxIndex);
      updateGalleryView();
    });
  });

  window.addEventListener("resize", updateGalleryView);
  updateGalleryView();
}

function openGalleryModal(index) {
  const modal = document.getElementById("galleryModal");
  const modalImage = document.getElementById("modalImage");
  const modalTag = document.getElementById("modalTag");
  const modalTitle = document.getElementById("modalTitle");
  const modalDesc = document.getElementById("modalDesc");

  const data = galleryData[index] || galleryData[0];

  if (modalImage) modalImage.src = data.image;
  if (modalTag) modalTag.textContent = data.tag;
  if (modalTitle) modalTitle.textContent = data.title;
  if (modalDesc) modalDesc.textContent = data.desc;

  if (modal) modal.classList.add("show");
}

function closeGalleryModal() {
  const modal = document.getElementById("galleryModal");
  if (modal) modal.classList.remove("show");
}



function initHeroAnimation() {
  const sceneRoot = document.getElementById('scene-root');
  if (!sceneRoot) return;

  const getSvg = id => document.querySelector('#' + id + ' svg');
  const R = Math.random;
  const f = v => v.toFixed(1);

  
  const makeWindows = (x, y, w, h, cols, rows, winW, winH, color) => {
    const gapX = (w - cols * winW) / (cols + 1);
    const gapY = (h - rows * winH) / (rows + 1);
    let str = `<g fill="${color}">`;
    for (let j = 0; j < rows; j++) {
      for (let i = 0; i < cols; i++) {
        const q = R();
        const isTwinkle = q < 0.35;
        str += `<rect ${isTwinkle ? `class="window-twinkle" style="animation-delay:-${f(R() * 4)}s;animation-duration:${f(3 + R() * 3)}s"` : 'opacity="0.85"'} 
        x="${f(x + gapX + i * (winW + gapX))}" 
        y="${f(y + gapY + j * (winH + gapY))}" 
        width="${winW}" height="${winH}" rx="2"/>`;
      }
    }
    return str + '</g>';
  };

  const makeWheel = (x, y, r) => `
  <g transform="translate(${x} ${y}) scale(${r / 8})">
    <g class="wheel-spin">
      <circle r="8" fill="#0f172a"/>
      <circle r="3" fill="#cbd5e1"/>
      <path d="M0 -6V6 M-6 0H6" stroke="#94a3b8" stroke-width="1.5"/>
    </g>
  </g>`;

  const makeBus = (w, color, label, stripe, flip, route) => {
    let windows = '', n = 5, winW = (w - 50) / n;
    for (let i = 0; i < n; i++) windows += `<rect x="${12 + i * winW}" y="7" width="${winW - 6}" height="13" rx="2"/>`;
    return `
    <rect y="2" width="${w}" height="34" rx="7" fill="${color}"/>
    <rect y="${stripe[0]}" width="${w}" height="${stripe[1]}" fill="${stripe[2]}"/>
    
    <rect x="${w - 28}" y="3" width="18" height="3.5" rx="1" fill="#0f172a"/>
    <text x="${w - 19}" y="6" fill="#facc15" font-size="2.6" font-weight="900" text-anchor="middle">${route || 'SURABAYA'}</text>
    <g fill="#e0f2fe">${windows}<rect x="${w - 30}" y="7" width="22" height="14" fill="#bae6fd"/></g>
    <text transform="translate(${w / 2 - 6} ${stripe[3]})${flip ? ' scale(-1 1)' : ''}" fill="#fff" font-size="7.5" font-weight="900" text-anchor="middle" letter-spacing="1">${label}</text>
    
    <circle cx="${w - 6}" cy="26" r="2.8" fill="#fef08a" filter="drop-shadow(2px 0 3px rgba(254,240,138,0.8))"/>
    <circle cx="6" cy="26" r="2" fill="#ef4444" filter="drop-shadow(-2px 0 3px rgba(239,68,68,0.8))"/>
    ${makeWheel(38, 36, 8)}${makeWheel(w - 42, 36, 8)}`;
  };

  const makeCar = () => `
  <path d="M8 26L24 10H66L84 24H94V32H2V26Z" fill="#0f172a"/>
  <path d="M28 12H44V22H24ZM48 12H64L76 22H48Z" fill="#bae6fd"/>
  <circle cx="92" cy="26" r="2.5" fill="#fef08a"/>
  <circle cx="4" cy="26" r="2" fill="#ef4444"/>
  ${makeWheel(24, 32, 7)}${makeWheel(72, 32, 7)}`;

  const makePerson = (shirt, pants, skin, hair, opt = {}) => `
  <rect class="ped-leg" x="4" y="29" width="5" height="18" rx="2" fill="${pants}"/>
  <rect class="ped-leg ped-alt" x="11" y="29" width="5" height="18" rx="2" fill="${pants}" opacity="0.85"/>
  ${opt.skirt ? `<path d="M3 28H17L20 42H0Z" fill="${opt.skirt}"/>` : ''}
  <rect x="3" y="12" width="14" height="18" rx="5" fill="${shirt}"/>
  ${opt.lanyard ? `<line x1="8" y1="12" x2="10" y2="20" stroke="#ef4444" stroke-width="1.2"/><rect x="9" y="20" width="3" height="4" fill="#fff"/>` : ''}
  <rect class="ped-arm" x="7" y="14" width="5" height="14" rx="2.5" fill="${shirt}"/>
  <circle cx="10" cy="7" r="6" fill="${skin}"/>
  ${opt.hijab ? `<path d="M3 8Q3 0 10 0Q17 0 17 8V16H3Z" fill="${opt.hijab}"/><circle cx="10" cy="8" r="4.5" fill="${skin}"/>` : `<path d="M4 6Q5 0 10 0Q16 0 16 6Q10 3 4 6Z" fill="${hair}"/>`}`;

  const makeMotion = (inner, w, hh, base, scale, dur, delay, dir) => `
  <g transform="translate(0 ${f(base - hh * scale)})">
    <g class="${dir > 0 ? 'drive-right' : 'drive-left'}" style="animation-duration:${dur}s;animation-delay:${delay}s">
      <g transform="scale(${scale})">
        <g class="chassis-bounce">
          ${dir > 0 ? inner : `<g transform="translate(${w} 0) scale(-1 1)">${inner}</g>`}
        </g>
      </g>
    </g>
  </g>`;

  
  const layerFarSvg = getSvg('layer-far');
  if (layerFarSvg) {
    let farStr = `
    <defs>
      <linearGradient id="horizonFog" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0.3" stop-color="#c6e8fc" stop-opacity="0"/>
        <stop offset="1" stop-color="#c6e8fc" stop-opacity="0.85"/>
      </linearGradient>
    </defs>
    <path d="M0 580V470Q200 370 380 470T760 470Q900 270 1040 470T1400 480Q1600 370 1780 470T1920 440V580Z" fill="#72a8d8" opacity="0.45"/>
    <path d="M0 580V510Q260 420 520 510T1000 500Q1250 400 1500 510T1920 490V580Z" fill="#9ecbf0" opacity="0.55"/>`;

    for (let x = 0; x < 1920; x += 58) {
      const h = 90 + R() * 160;
      farStr += `<rect x="${x}" y="${580 - h}" width="${42 + R() * 22}" height="${h}" rx="2" fill="${R() < 0.5 ? '#4f759e' : '#41638a'}"/>`;
    }

    // Tugu Pahlawan Surabaya
    farStr += `
    <path d="M540 580L545 340L548 270L552 230L556 270L559 340L564 580Z" fill="#3b597f"/>
    <rect x="532" y="560" width="40" height="20" fill="#3b597f"/>
    <rect width="1920" height="580" fill="url(#horizonFog)"/>`;
    layerFarSvg.innerHTML = farStr;
  }

  
  const layerMidSvg = getSvg('layer-mid');
  if (layerMidSvg) {
    let midStr = layerMidSvg.innerHTML; // Keeps existing <defs>

    // [GEDUNG 1 - KIRI 1]: Menara Bank Jatim Modern
    midStr += `
    <rect x="20" y="325" width="125" height="250" rx="4" fill="#0f2b48" stroke="#1e3a8a" stroke-width="1.5"/>
    <rect x="133" y="325" width="12" height="250" fill="#0b1b2d" opacity="0.5"/>
    <path d="M20 325 Q82 285 145 325 Z" fill="#0284c7" stroke="#38bdf8" stroke-width="1.5"/>
    <rect x="52" y="308" width="60" height="14" rx="2" fill="#ffffff" filter="drop-shadow(0 2px 3px rgba(0,0,0,0.3))"/>
    <text x="82" y="318" fill="#b91c1c" font-size="7" font-weight="900" text-anchor="middle" letter-spacing="0.5">BANK JATIM</text>
    ${makeWindows(28, 335, 100, 195, 3, 6, 26, 20, '#38bdf8')}
    <rect x="62" y="542" width="40" height="33" fill="#0f172a" rx="1"/>
    <rect x="65" y="546" width="34" height="29" fill="#7dd3fc" opacity="0.9"/>`;

    // [GEDUNG 2 - KIRI 2]: Hotel & Apartemen Bisnis Surabaya
    midStr += `
    <rect x="160" y="280" width="110" height="295" rx="3" fill="#334155" stroke="#1e293b" stroke-width="1.5"/>
    <rect x="175" y="268" width="80" height="12" rx="1" fill="#78350f"/>
    <circle cx="190" cy="265" r="7" fill="#15803d"/>
    <circle cx="240" cy="265" r="7" fill="#ec4899"/>
    ${[295, 335, 375, 415, 455, 495].map(y => `
      <rect x="168" y="${y}" width="94" height="24" rx="2" fill="#1e293b"/>
      <rect x="174" y="${y + 3}" width="36" height="18" rx="1" fill="#fde047" opacity="0.9"/>
      <rect x="218" y="${y + 3}" width="36" height="18" rx="1" fill="#fde047" opacity="0.9"/>
      <line x1="168" y1="${y + 24}" x2="262" y2="${y + 24}" stroke="#facc15" stroke-width="1.5"/>
    `).join('')}
    <rect x="195" y="545" width="40" height="30" fill="#0f172a"/>`;

    // [GEDUNG 3 - KIRI 3]: Menara Graha Perkantoran
    midStr += `
    <rect x="285" y="340" width="120" height="235" rx="4" fill="#1e293b" stroke="#334155" stroke-width="1.5"/>
    <rect x="300" y="325" width="90" height="15" fill="#0f172a" rx="2"/>
    <line x1="345" y1="325" x2="345" y2="295" stroke="#cbd5e1" stroke-width="2.5"/>
    <circle cx="345" cy="293" r="3" fill="#ff0000" class="tower-beacon"/>
    ${makeWindows(295, 350, 100, 185, 3, 5, 26, 24, '#7dd3fc')}`;

    // [GEDUNG 4 - KIRI 4]: Menara Pelayanan Publik
    midStr += `
    <rect x="420" y="310" width="115" height="265" rx="4" fill="#0f3b73" stroke="#1d4ed8" stroke-width="1.5"/>
    <polygon points="420,310 477,270 535,310" fill="#1e40af"/>
    <line x1="477" y1="270" x2="477" y2="240" stroke="#cbd5e1" stroke-width="2"/>
    <circle cx="477" cy="238" r="3" fill="#ff0000" class="tower-beacon"/>
    ${makeWindows(430, 320, 95, 210, 3, 6, 24, 22, '#bfdbfe')}`;

    // 1. BALAI KOTA SURABAYA GRAND
    midStr += `
    <rect x="545" y="415" width="530" height="160" fill="rgba(0,0,0,0.18)" rx="4"/>
    <polygon points="550,446 595,398 1030,398 1075,446" fill="#b91c1c" stroke="#991b1b" stroke-width="2"/>
    <polygon points="595,398 735,398 735,446 595,446" fill="#dc2626" opacity="0.3"/>
    <polygon points="885,398 1030,398 1030,446 885,446" fill="#7f1d1d" opacity="0.3"/>
    <rect x="560" y="442" width="505" height="133" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1.5"/>

    
    <rect x="560" y="420" width="35" height="155" fill="#f1f5f9" stroke="#94a3b8" stroke-width="1"/>
    <rect x="1030" y="420" width="35" height="155" fill="#f1f5f9" stroke="#94a3b8" stroke-width="1"/>

    
    <rect x="740" y="380" width="140" height="195" fill="#ffffff" stroke="#94a3b8" stroke-width="1.5" filter="drop-shadow(0 4px 8px rgba(0,0,0,0.15))"/>
    <rect x="770" y="368" width="80" height="18" rx="2" fill="#b91c1c" stroke="#ffffff" stroke-width="1.2"/>
    <text x="810" y="380" fill="#ffffff" font-size="8.5" font-weight="900" text-anchor="middle" letter-spacing="0.8">BALAI KOTA</text>
    <rect x="765" y="390" width="90" height="8" rx="1.5" fill="#0284c7"/>
    <text x="810" y="396" fill="#ffffff" font-size="5" font-weight="800" text-anchor="middle">PEMERINTAH KOTA SURABAYA</text>

    
    <rect x="755" y="405" width="7" height="120" fill="#cbd5e1"/>
    <rect x="790" y="405" width="7" height="120" fill="#cbd5e1"/>
    <rect x="823" y="405" width="7" height="120" fill="#cbd5e1"/>
    <rect x="858" y="405" width="7" height="120" fill="#cbd5e1"/>

    <rect x="767" y="412" width="18" height="48" fill="#38bdf8" opacity="0.85" rx="1"/>
    <rect x="802" y="412" width="16" height="48" fill="#38bdf8" opacity="0.85" rx="1"/>
    <rect x="835" y="412" width="18" height="48" fill="#38bdf8" opacity="0.85" rx="1"/>

    
    <line x1="810" y1="575" x2="810" y2="330" stroke="#e2e8f0" stroke-width="3"/>
    <circle cx="810" cy="329" r="3.5" fill="#facc15"/>
    <g transform="translate(810, 330)">
      <g class="flag-flutter">
        <rect x="0" y="0" width="32" height="10" fill="#dc2626"/>
        <rect x="0" y="10" width="32" height="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="0.3"/>
      </g>
    </g>

    
    <rect x="560" y="525" width="505" height="7" fill="#15803d"/>
    ${[560, 600, 640, 680, 720, 760, 800, 840, 880, 920, 960, 1000, 1030].map(x => `
      <polygon points="${x},532 ${x + 20},532${x + 10},538" fill="#ffffff"/>
      <polygon points="${x + 20},532 ${x + 40},532${x + 30},538" fill="#15803d"/>
    `).join('')}

    <rect x="780" y="535" width="60" height="40" fill="#0f172a" rx="2"/>
    <rect x="785" y="540" width="24" height="35" fill="#38bdf8" opacity="0.85"/>
    <rect x="811" y="540" width="24" height="35" fill="#38bdf8" opacity="0.85"/>`;

    for (let i = 0; i < 7; i++) {
      const wxL = 595 + i * 19;
      const wxR = 885 + i * 19;
      midStr += `
      <rect x="${wxL}" y="458" width="12" height="18" rx="1" fill="#7dd3fc" stroke="#64748b" stroke-width="0.8"/>
      <rect x="${wxL}" y="490" width="12" height="18" rx="1" fill="#7dd3fc" stroke="#64748b" stroke-width="0.8"/>
      <rect x="${wxR}" y="458" width="12" height="18" rx="1" fill="#7dd3fc" stroke="#64748b" stroke-width="0.8"/>
      <rect x="${wxR}" y="490" width="12" height="18" rx="1" fill="#7dd3fc" stroke="#64748b" stroke-width="0.8"/>`;
    }

    // 2. GEDUNG DISKOMINFO JAWA TIMUR
    midStr += `
    <rect x="1115" y="235" width="375" height="340" fill="rgba(0,0,0,0.18)" rx="4"/>

    
    <rect x="1120" y="270" width="85" height="305" rx="5" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1.5"/>
    <path d="M1132 335 H1192 V575 H1132 Z" fill="url(#rotundaGlass)"/>
    ${[345, 375, 405, 435, 465, 495, 525, 555].map(y => `
      <rect x="1124" y="${y}" width="10" height="4" fill="#0284c7" rx="1"/>
      <rect x="1190" y="${y}" width="10" height="4" fill="#0284c7" rx="1"/>
      <line x1="1132" y1="${y + 2}" x2="1192" y2="${y + 2}" stroke="#ffffff" stroke-width="1" opacity="0.7"/>
    `).join('')}

    
    <ellipse cx="1162" cy="270" rx="42" ry="14" fill="#cbd5e1" stroke="#b91c1c" stroke-width="2.5"/>
    <ellipse cx="1162" cy="264" rx="36" ry="11" fill="none" stroke="#64748b" stroke-width="2"/>
    <line x1="1130" y1="270" x2="1130" y2="262" stroke="#b91c1c" stroke-width="2"/>
    <line x1="1162" y1="270" x2="1162" y2="260" stroke="#b91c1c" stroke-width="2"/>
    <line x1="1194" y1="270" x2="1194" y2="262" stroke="#b91c1c" stroke-width="2"/>

    
    <g transform="translate(1144, 292)">
      <circle cx="18" cy="18" r="18" fill="#ffffff" stroke="#0284c7" stroke-width="1.5" filter="drop-shadow(0 3px 5px rgba(0,0,0,0.22))"/>
      <image href="images/logo_diskominfo.jpg" xlink:href="images/logo_diskominfo.jpg" 
             onerror="this.setAttribute('href','logo_diskominfo.jpg');"
             x="3" y="3" width="30" height="30" preserveAspectRatio="xMidYMid meet"/>
    </g>

    
    <line x1="1162" y1="258" x2="1162" y2="135" stroke="#cbd5e1" stroke-width="4"/>
    <line x1="1150" y1="170" x2="1174" y2="170" stroke="#cbd5e1" stroke-width="2.5"/>
    <line x1="1154" y1="195" x2="1170" y2="195" stroke="#cbd5e1" stroke-width="2"/>
    
    <g transform="translate(1162, 135)">
      <circle cx="0" cy="0" r="5" fill="#ff0000" class="tower-beacon"/>
      <circle cx="0" cy="0" r="18" class="signal-pulse-ring sig-delay-1"/>
      <circle cx="0" cy="0" r="18" class="signal-pulse-ring sig-delay-2"/>
      <circle cx="0" cy="0" r="18" class="signal-pulse-ring sig-delay-3"/>
    </g>

    
    <rect x="1202" y="275" width="270" height="300" fill="#0056b3" stroke="#023e8a" stroke-width="1.5"/>
    <rect x="1454" y="250" width="18" height="325" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
    <polygon points="1452,250 1474,245 1474,252 1452,257" fill="#dc2626"/>

    <line x1="1202" y1="365" x2="1454" y2="365" stroke="#ffffff" stroke-width="1" opacity="0.4"/>
    <line x1="1202" y1="465" x2="1454" y2="465" stroke="#ffffff" stroke-width="1" opacity="0.4"/>
    <line x1="1202" y1="525" x2="1454" y2="525" stroke="#ffffff" stroke-width="1" opacity="0.4"/>
    <line x1="1286" y1="275" x2="1286" y2="575" stroke="#ffffff" stroke-width="1" opacity="0.4"/>
    <line x1="1370" y1="275" x2="1370" y2="575" stroke="#ffffff" stroke-width="1" opacity="0.4"/>

    
    <rect x="1208" y="242" width="242" height="34" rx="3" fill="#0f3b73" stroke="#38bdf8" stroke-width="1.5" filter="drop-shadow(0 3px 5px rgba(0,0,0,0.25))"/>
    <text x="1329" y="256" fill="#ffffff" font-size="8.5" font-weight="900" text-anchor="middle" letter-spacing="0.5">DINAS KOMUNIKASI DAN INFORMATIKA</text>
    <text x="1329" y="269" fill="#ffffff" font-size="9" font-weight="900" text-anchor="middle" letter-spacing="1">PROVINSI JAWA TIMUR</text>

    
    ${[1218, 1252, 1286, 1320, 1354, 1388, 1422].map(x => `
      <rect x="${x}" y="280" width="20" height="12" fill="#ffffff" stroke="#cbd5e1" stroke-width="0.8"/>
    `).join('')}

    
    <rect x="1224" y="304" width="210" height="128" rx="5" fill="#facc15" stroke="#ca8a04" stroke-width="3.5" filter="drop-shadow(0 4px 8px rgba(0,0,0,0.3))"/>
    <rect x="1231" y="311" width="196" height="114" rx="2" fill="url(#ledGridPattern)" stroke="#14b8a6" stroke-width="1.5"/>

    <g transform="translate(1308, 325)">
      <rect x="-8" y="-2" width="58" height="52" rx="6" fill="#ffffff" opacity="0.95" filter="drop-shadow(0 2px 4px rgba(0,0,0,0.2))"/>
      <image href="images/logo_diskominfo.jpg" xlink:href="images/logo_diskominfo.jpg"
             onerror="this.setAttribute('href','logo_diskominfo.jpg');"
             x="-5" y="1" width="52" height="46" preserveAspectRatio="xMidYMid meet"/>
    </g>
    <text x="1329" y="394" fill="#ffffff" font-size="7.5" font-weight="900" text-anchor="middle" letter-spacing="0.8" filter="drop-shadow(0 1px 2px rgba(0,0,0,0.6))">DISKOMINFO JAWA TIMUR</text>
    <text x="1329" y="408" fill="#99f6e4" font-size="6.5" font-weight="800" text-anchor="middle" letter-spacing="0.5" filter="drop-shadow(0 1px 2px rgba(0,0,0,0.6))">TRANSFORMASI DIGITAL JATIM</text>

    
    <rect x="1245" y="475" width="20" height="40" fill="#ffffff" stroke="#cbd5e1" stroke-width="1" rx="1"/>
    <rect x="1320" y="475" width="20" height="40" fill="#ffffff" stroke="#cbd5e1" stroke-width="1" rx="1"/>
    <rect x="1395" y="475" width="20" height="40" fill="#ffffff" stroke="#cbd5e1" stroke-width="1" rx="1"/>

    <rect x="1304" y="530" width="50" height="45" fill="#0f172a" rx="2"/>
    <rect class="sliding-door" x="1307" y="534" width="21" height="41" fill="#38bdf8" opacity="0.85"/>
    <rect x="1330" y="534" width="21" height="41" fill="#38bdf8" opacity="0.85"/>`;

    // 3. TOKO INDOMARET
    midStr += `
    <rect x="1505" y="475" width="135" height="100" rx="4" fill="#f8fafc" stroke="#cbd5e1" stroke-width="2"/>
    <rect x="1518" y="464" width="22" height="11" rx="2" fill="#94a3b8"/>
    <rect x="1590" y="466" width="20" height="9" rx="2" fill="#94a3b8"/>
    <rect x="1505" y="475" width="135" height="8" fill="#0056b3"/>
    <rect x="1505" y="483" width="135" height="8" fill="#dc2626"/>
    <rect x="1505" y="491" width="135" height="8" fill="#facc15"/>
    <rect x="1518" y="477" width="108" height="18" rx="3" fill="#ffffff" filter="drop-shadow(0 2px 3px rgba(0,0,0,0.18))"/>
    <rect x="1524" y="481" width="4" height="10" fill="#0056b3"/>
    <rect x="1528" y="481" width="4" height="10" fill="#dc2626"/>
    <rect x="1532" y="481" width="4" height="10" fill="#facc15"/>
    <text x="1578" y="490" fill="#0056b3" font-size="10" font-weight="900" text-anchor="middle">Indomaret</text>
    <rect x="1501" y="501" width="143" height="5" rx="2" fill="#64748b"/>
    <rect x="1514" y="510" width="116" height="65" rx="2" fill="#e0f2fe" stroke="#94a3b8" stroke-width="1.5"/>
    <rect x="1555" y="518" width="38" height="57" fill="#bae6fd"/>
    <rect class="sliding-door" x="1555" y="518" width="19" height="57" fill="#7dd3fc" stroke="#0284c7"/>
    <rect x="1520" y="525" width="24" height="42" fill="#fed7aa" opacity="0.75"/>
    <rect x="1600" y="513" width="26" height="12" rx="2" fill="#0284c7"/>
    <text x="1613" y="522" fill="#ffffff" font-size="5.5" font-weight="900" text-anchor="middle">ATM 24h</text>
    <path d="M1492 420V575" stroke="#64748b" stroke-width="3"/>
    <rect x="1480" y="420" width="24" height="24" rx="3" fill="#0056b3" stroke="#ffffff" stroke-width="1.2"/>
    <text x="1492" y="432" fill="#ffffff" font-size="6" font-weight="900" text-anchor="middle">i-mart</text>
    <rect x="1482" y="435" width="20" height="5" fill="#dc2626"/>`;

    // [GEDUNG 5 - KANAN 1]: Grand Surabaya Financial Tower
    midStr += `
    <rect x="1660" y="210" width="150" height="365" rx="5" fill="#0f172a" stroke="#1e293b" stroke-width="2"/>
    <polygon points="1660,210 1735,160 1810,210" fill="#1e3a8a"/>
    <line x1="1735" y1="160" x2="1735" y2="120" stroke="#cbd5e1" stroke-width="3"/>
    <circle cx="1735" cy="118" r="4" fill="#ff0000" class="tower-beacon"/>
    <ellipse cx="1735" cy="205" rx="32" ry="10" fill="#334155" stroke="#facc15" stroke-width="2"/>
    <text x="1735" y="209" fill="#ffffff" font-size="9" font-weight="900" text-anchor="middle">H</text>
    ${makeWindows(1670, 225, 130, 310, 4, 8, 24, 26, '#fef08a')}
    <rect x="1715" y="540" width="40" height="35" fill="#0284c7" rx="2"/>`;

    // [GEDUNG 6 - KANAN 2]: Hotel Bintang Lima Ujung Kanan
    midStr += `
    <rect x="1825" y="290" width="95" height="285" rx="4" fill="#1e293b" stroke="#334155" stroke-width="1.5"/>
    <rect x="1835" y="275" width="75" height="15" fill="#0f172a" rx="2"/>
    <circle cx="1872" cy="273" r="3" fill="#ff0000" class="tower-beacon"/>
    ${makeWindows(1835, 305, 75, 235, 3, 7, 18, 22, '#7dd3fc')}`;

    layerMidSvg.innerHTML = midStr;
  }

  
  const layerForeSvg = getSvg('layer-fore');
  if (layerForeSvg) {
    let foreStr = `
    <defs>
      <linearGradient id="lawnGrad" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0" stop-color="#4ade80"/>
        <stop offset="1" stop-color="#1b733e"/>
      </linearGradient>
    </defs>
    <rect y="560" width="1920" height="45" fill="url(#lawnGrad)"/>`;

    for (let x = 10; x < 1920; x += 64) {
      if ((x > 1200 && x < 1380) || (x > 1530 && x < 1610) || (x > 770 && x < 850)) continue;
      const r = 14 + R() * 8;
      foreStr += `<circle cx="${x}" cy="${570 + R() * 6}" r="${f(r)}" fill="${R() < 0.5 ? '#15803d' : '#16a34a'}"/>`;
      for (let i = 0; i < 3; i++) {
        foreStr += `<circle cx="${f(x - r / 2 + R() * r)}" cy="${f(564 + R() * 12)}" r="2.8" fill="${['#ec4899', '#facc15', '#ffffff'][i]}"/>`;
      }
    }

    // Trotoar Pedestrian dengan Garis Paving Halus
    foreStr += `
    <rect y="605" width="1920" height="25" fill="#8fa0b5"/>
    <rect y="605" width="1920" height="3" fill="#cbd5e1"/>
    <path d="M0 617H1920" stroke="#eab308" stroke-width="4.5" stroke-dasharray="14 10"/>`;

    // Pohon Tabebuya Surabaya
    [
      [90, 'g', 1.05],
      [260, 'y', 1.0],
      [480, 'p', 0.95],
      [710, 'g', 0.9],
      [910, 'y', 0.9],
      [1105, 'p', 1.05],
      [1485, 'y', 0.95],
      [1650, 'p', 1.0],
      [1860, 'g', 1.0]
    ].forEach((t, i) => {
      const c = t[1] === 'g'
        ? '<circle cy="-95" r="34" fill="#15803d"/><circle cx="-10" cy="-105" r="18" fill="#22c55e"/>'
        : t[1] === 'y'
          ? '<circle cy="-90" r="40" fill="#eab308"/><circle cx="-12" cy="-100" r="22" fill="#facc15"/><circle cx="18" cy="-96" r="18" fill="#fde047"/>'
          : '<circle cy="-86" r="30" fill="#ec4899"/><circle cx="-8" cy="-96" r="18" fill="#f472b6"/>';
      foreStr += `
      <g transform="translate(${t[0]} 607) scale(${t[2]})">
        <g class="tree-sway" style="animation-delay:-${f(i * 0.8)}s">
          <rect x="-5" y="-65" width="10" height="65" fill="#78350f" rx="2"/>
          ${c}
        </g>
      </g>`;
    });

    // Lampu Penerangan Taman
    [210, 520, 960, 1110, 1480, 1780].forEach(x => {
      foreStr += `
      <g transform="translate(${x} 610)">
        <path d="M0 0V-75Q0 -82 9 -82H19" stroke="#475569" stroke-width="3.5" fill="none"/>
        <rect x="16" y="-86" width="11" height="6" rx="2" fill="#fef08a"/>
      </g>`;
    });

        [
      [['#d4a373', '#6f4e37', '#f3c9a5', '#1e293b', { lanyard: true }], 1, 626, 44, 0],
      [['#d4a373', '#5a3d28', '#c68b59', '#1e293b', { hijab: '#c68b59', skirt: '#6f4e37', lanyard: true }], 1, 623, 44, -22],
      [['#ffffff', '#1d4ed8', '#fed7aa', '#1e293b'], -1, 624, 38, -10],
      [['#fde047', '#334155', '#f3c9a5', '#0f172a'], -1, 628, 38, -28],
      [['#ffffff', '#dc2626', '#f3c9a5', '#1e293b', { hijab: '#ffffff', skirt: '#dc2626' }], 1, 622, 50, -34]
    ].forEach(p => {
      foreStr += makeMotion(makePerson(...p[0]), 20, 47, p[2], 1.1, p[3], p[4], p[1]);
    });

        foreStr += `
    <rect y="630" width="1920" height="90" fill="#1e293b"/>
    <rect y="630" width="1920" height="4" fill="#334155"/>
    <path d="M0 675H1920" stroke="#f8fafc" stroke-width="4" stroke-dasharray="45 45" opacity="0.85"/>`;

    // Reflektor Marka Jalan Mata Kucing Berpendar
    for (let mx = 22; mx < 1920; mx += 90) {
      foreStr += `<circle cx="${mx}" cy="675" r="1.6" fill="#fef08a" opacity="0.9"/>`;
    }

    // 1. Suroboyo Bus (Merah - Lajur Bawah, Kiri ke Kanan)
    foreStr += makeMotion(makeBus(190, '#dc2626', 'SUROBOYO BUS', [24, 3, '#facc15', 33], 0, 'PURABAYA'), 190, 44, 715, 1, 24, 0, 1);

    // 2. Bus Trans Jatim (Tosca - Lajur Bawah, Kiri ke Kanan)
    foreStr += makeMotion(makeBus(180, '#008080', 'TRANS JATIM', [22, 4, '#ffffff', 34], 0, 'KORIDOR I'), 180, 44, 715, 1, 24, -12, 1);

    // 3. Feeder WiraWiri Suroboyo (Putih-Merah - Lajur Atas, Kanan ke Kiri)
    foreStr += makeMotion(makeBus(120, '#f8fafc', 'WIRAWIRI', [23, 13, '#dc2626', 31], 1, 'FEEDER 02'), 120, 44, 668, 0.8, 16.5, 0, -1);

    // 4. Mobil Sedan Dinas (Lajur Atas, Kanan ke Kiri)
    foreStr += makeMotion(makeCar(), 96, 39, 668, 0.8, 16.5, -8, -1);

    layerForeSvg.innerHTML = foreStr;
  }

  
  let skyElements = `
  <svg width="0" height="0" style="position:absolute;">
    <symbol id="cloud-sym" viewBox="0 0 200 90">
      <ellipse cx="60" cy="62" rx="55" ry="26"/>
      <circle cx="96" cy="40" r="34"/>
      <circle cx="142" cy="54" r="28"/>
      <ellipse cx="112" cy="70" rx="84" ry="20"/>
    </symbol>
  </svg>`;

  [
    [6, 250, 0.6, 100, 0],
    [14, 330, 0.85, 70, -30],
    [23, 190, 0.65, 84, -52],
    [33, 290, 0.5, 120, -78],
    [9, 170, 0.7, 90, -58]
  ].forEach(c => {
    skyElements += `<svg class="cloud-svg" viewBox="0 0 200 90" style="top:${c[0]}vh;width:${c[1]}px;opacity:${c[2]};animation-duration:${c[3]}s;animation-delay:${c[4]}s"><use href="#cloud-sym"/></svg>`;
  });

  // Pesawat Komersial Juanda & Vapor Trail
  skyElements += `
  <div class="plane-unit">
    <div class="trail-line"></div>
    <svg width="92" height="36" viewBox="0 0 65 26">
      <polygon points="24,12 13,1 26,1 38,12" fill="#e2e8f0"/>
      <polygon points="26,15 15,25 28,25 38,15" fill="#cbd5e1"/>
      <polygon points="4,11 0,1 8,1 17,11" fill="#0284c7"/>
      <path d="M4 14Q1 14 2 11.5Q3 10 8 10L45 10Q58 10 63 13.5Q62 16 52 16L45 17L8 17Q4 17 4 14Z" fill="#fff"/>
      <path d="M10 13H54" stroke="#0369a1" stroke-width="1.8"/>
      <g fill="#0f172a">
        <circle cx="50" cy="12" r="1"/>
        <circle cx="46" cy="12" r="1"/>
        <circle cx="42" cy="12" r="1"/>
        <circle cx="38" cy="12" r="1"/>
      </g>
    </svg>
  </div>`;

  // Burung Mengepak Sayap
  [
    [19, 26, 0],
    [25, 34, -9],
    [17, 30, -17],
    [29, 40, -22]
  ].forEach(b => {
    skyElements += `
    <div class="bird-unit" style="top:${b[0]}vh;animation-duration:${b[1]}s;animation-delay:${b[2]}s">
      <svg width="26" height="12" viewBox="0 0 26 12">
        <path class="bird-wing" d="M1 10Q7 0 13 9Q19 0 25 10" fill="none" stroke="#1e3a5f" stroke-width="1.8" stroke-linecap="round" opacity="0.75"/>
      </svg>
    </div>`;
  });

  sceneRoot.insertAdjacentHTML('afterbegin', skyElements);

  
  const layers = [
    document.getElementById('layer-far'),
    document.getElementById('layer-mid'),
    document.getElementById('layer-fore')
  ];
  const depths = { 'layer-far': -8, 'layer-mid': -18, 'layer-fore': -30 };

  window.addEventListener('mousemove', e => {
    const xRatio = e.clientX / window.innerWidth - 0.5;
    layers.forEach(layer => {
      if (layer) {
        layer.style.setProperty('--px', f(xRatio * depths[layer.id]) + 'px');
      }
    });
  });
}