document.addEventListener("DOMContentLoaded", () => {
  // --- PATH LOGIC FOR REUSABILITY ---
  const isHome = window.location.pathname.endsWith("index.php") || window.location.pathname === "/";
  const isInHtml = window.location.pathname.includes("/html/");
  const basePath = isInHtml ? "../" : "";

  // --- DYNAMIC HTML TEMPLATES ---
  const headerHTML = `
    <header>
      <div class="header-inner">
        <div class="logo-wrapper">
          <a href="${isHome ? '#' : basePath + 'index.php'}" class="logo-link">
            <img src="${basePath}img/favicon.png" alt="SG Logo" class="logo-icon">
            <span class="logo-text">SWAP</span>
          </a>
        </div>
        <nav>
          <ul class="nav-list">
            <li><a href="${isHome ? '#header-placeholder' : basePath + 'index.php#header-placeholder'}">Home</a></li>
            <li><a href="${isHome ? '#hitos' : basePath + 'index.php#hitos'}">Hitos</a></li>
            <li><a href="${isHome ? '#galeria' : basePath + 'index.php#galeria'}">Galería</a></li>
            <li><a href="${isHome ? '#contacto' : basePath + 'index.php#contacto'}">Contacto</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle">Hitos <i class="fas fa-chevron-down"></i></a>
              <ul class="dropdown-menu">
                <li><a href="${basePath}html/hito1.php">Hito 1</a></li>
                <li><a href="${basePath}html/hito2.php">Hito 2</a></li>
                <li><a href="${basePath}html/hito3.php">Hito 3</a></li>
                <li><a href="${basePath}html/hito4.php">Hito 4</a></li>
                <li><a href="${basePath}html/hito5.php">Hito 5</a></li>
                <li><a href="${basePath}html/hito6.php">Hito 6</a></li>
              </ul>
            </li>
            <li class="header-lang">
              <select id="lang-select">
                <option>Español (ES)</option>
                <option>English (US)</option>
                <option>Français (FR)</option>
                <option>Deutsch (DE)</option>
              </select>
            </li>
          </ul>
          <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </nav>
      </div>
    </header>
  `;

  const footerHTML = `
    <footer id="contacto">
      <div class="footer-content">
        <div class="footer-top">
          <div class="footer-links">
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Site Map</a>
          </div>
          <div class="footer-lang">
            <select id="lang-select-footer">
              <option>Español (ES)</option>
              <option>English (US)</option>
              <option>Français (FR)</option>
              <option>Deutsch (DE)</option>
            </select>
          </div>
        </div>
        <div class="footer-bottom">
          <a href="#">Privacy</a> |
          <a href="#">Legal</a> |
          <a href="#">Cookies</a> |
          <a href="#">Terms</a>
        </div>
        <p class="footer-logo">World Forge © 2025</p>
      </div>
    </footer>
  `;

  // --- INJECT HTML INTO PLACEHOLDERS ---
  const headerPlaceholder = document.getElementById("header-placeholder");
  const footerPlaceholder = document.getElementById("footer-placeholder");

  if (headerPlaceholder) headerPlaceholder.innerHTML = headerHTML;
  if (footerPlaceholder) footerPlaceholder.innerHTML = footerHTML;

  // --- EVENT LISTENERS (HEADER/FOOTER) ---
  document.addEventListener("click", (e) => {
    const toggle = e.target.closest(".dropdown-toggle");
    if (toggle) {
      e.preventDefault();
      e.stopPropagation();
      const menu = toggle.nextElementSibling;
      menu.classList.toggle("show");
    } else {
      document.querySelectorAll(".dropdown-menu.show").forEach((menu) => menu.classList.remove("show"));
    }
  });

  const hamburger = document.getElementById("hamburger");
  const navList = document.querySelector(".nav-list");
  if (hamburger && navList) {
    hamburger.addEventListener("click", () => {
      navList.classList.toggle("active");
      hamburger.classList.toggle("active");
    });
  }

  // --- CAROUSEL LOGIC (CORRECTED) ---
  const slidesContainer = document.getElementById("slides");
  if (slidesContainer) {
    const originalSlides = Array.from(slidesContainer.children);
    const totalOriginalSlides = originalSlides.length;

    // If there are less than 3 slides, don't run the carousel.
    if (totalOriginalSlides < 3) {
        console.warn("Carousel requires at least 3 slides to function.");
        return;
    }
    
    // Clone slides for infinite loop
    const firstClone = originalSlides[0].cloneNode(true);
    const lastClone = originalSlides[totalOriginalSlides - 1].cloneNode(true);
    slidesContainer.appendChild(firstClone);
    slidesContainer.insertBefore(lastClone, originalSlides[0]);

    const slides = Array.from(slidesContainer.children);
    const totalSlides = slides.length; // This is totalOriginalSlides + 2

    // --- KEY FIX: Correct transform calculation ---
    // We need to calculate the transform to center the active slide.
    // This formula aligns the center of the active slide with the center of the viewport.
    const getTransform = (index) => {
      const slideWidth = 100 / 3; // Because we show 3 slides
      // Center of the slide at `index` is at (index + 0.5) * slideWidth.
      // We want this to be at 50% (center of screen).
      // So, transform = 50% - (index + 0.5) * slideWidth.
      return 50 - (index + 0.5) * slideWidth;
    };

    let currentIndex = 1; // Start with the first original slide centered
    let isTransitioning = false; // Flag to prevent clicks during transition

    // Generate dots
    const dotsContainer = document.querySelector(".carousel-dots");
    dotsContainer.innerHTML = originalSlides
      .map((_, i) => `<span class="dot${i === 0 ? " active" : ""}" data-slide="${i}"></span>`)
      .join("");
    const dots = dotsContainer.querySelectorAll(".dot");

    // Function to update classes for active, prev, next slides
    function updateSlideClasses() {
      slides.forEach((slide) => slide.classList.remove("active", "prev", "next"));

      // Add classes safely, checking for valid indices
      const activeSlide = slides[currentIndex];
      if (activeSlide) activeSlide.classList.add("active");

      const prevSlide = slides[currentIndex - 1];
      if (prevSlide) prevSlide.classList.add("prev");

      const nextSlide = slides[currentIndex + 1];
      if (nextSlide) nextSlide.classList.add("next");

      // Update dots based on the original slide index
      const originalIndex = (currentIndex - 1 + totalOriginalSlides) % totalOriginalSlides;
      dots.forEach((dot, i) => dot.classList.toggle("active", i === originalIndex));
    }

    // Move to specific slide
    function moveToSlide(index) {
      if (isTransitioning) return;
      isTransitioning = true;
      
      slidesContainer.style.transition = "transform 0.5s ease-in-out";
      currentIndex = index;
      slidesContainer.style.transform = `translateX(${getTransform(currentIndex)}%)`;
      updateSlideClasses();
    }

    // --- KEY FIX: Handle infinite loop on transition end ---
    slidesContainer.addEventListener("transitionend", () => {
      isTransitioning = false; // Re-enable clicks

      // If we've just shown the last clone (index 10), jump to the real first slide (index 1)
      if (currentIndex === totalSlides - 1) {
        slidesContainer.style.transition = "none";
        currentIndex = 1;
        slidesContainer.style.transform = `translateX(${getTransform(currentIndex)}%)`;
      } 
      // If we've just shown the first clone (index 0), jump to the real last slide (index 8)
      else if (currentIndex === 0) {
        slidesContainer.style.transition = "none";
        currentIndex = totalOriginalSlides;
        slidesContainer.style.transform = `translateX(${getTransform(currentIndex)}%)`;
      }
    });

    // Button controls
    document.getElementById("next").addEventListener("click", () => moveToSlide(currentIndex + 1));
    document.getElementById("prev").addEventListener("click", () => moveToSlide(currentIndex - 1));

    // Dot controls
    dots.forEach((dot, i) => {
      dot.addEventListener("click", () => moveToSlide(i + 1));
    });

    // Autoplay
    let autoplayInterval;
    function startAutoplay() {
      autoplayInterval = setTimeout(() => {
        moveToSlide(currentIndex + 1);
        startAutoplay();
      }, 10000);
    }
    function stopAutoplay() {
      clearTimeout(autoplayInterval);
    }

    document.addEventListener("visibilitychange", () => {
      if (document.hidden) {
        stopAutoplay();
      } else {
        startAutoplay();
      }
    });

    // Initial setup
    updateSlideClasses();
    startAutoplay();
  }
});
// --- CODE TOGGLE FUNCTION ---
function toggleCode(wrapperId) {
  const wrapper = document.getElementById(wrapperId);
  const container = wrapper.querySelector('.code-container');
  const button = wrapper.querySelector('.code-toggle');
  
  if (container.style.maxHeight === '300px') {
    container.style.maxHeight = 'none';
    button.textContent = 'Contraer';
    wrapper.classList.add('expanded');
  } else {
    container.style.maxHeight = '300px';
    button.textContent = 'Expandir';
    wrapper.classList.remove('expanded');
  }
}

// --- INITIALIZE CODE CONTAINERS ---
document.addEventListener('DOMContentLoaded', function() {
  const codeContainers = document.querySelectorAll('.code-container');
  codeContainers.forEach(container => {
    if (!container.style.maxHeight) {
      container.style.maxHeight = '300px';
    }
  });
});


//--Galeria--
const galleryImages = document.querySelectorAll('.gallery-item img');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const downloadBtn = document.getElementById('lightbox-download');
const closeBtn = document.querySelector('.lightbox-close');

galleryImages.forEach(img => {
  img.addEventListener('click', () => {
    lightboxImg.src = img.src;
    downloadBtn.href = img.src;
    lightbox.classList.add('show');
  });
});

closeBtn.addEventListener('click', () => {
  lightbox.classList.remove('show');
});

lightbox.addEventListener('click', (e) => {
  if (e.target === lightbox) {
    lightbox.classList.remove('show');
  }
});
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && lightbox.classList.contains('show')) {
    lightbox.classList.remove('show');
  }
});
