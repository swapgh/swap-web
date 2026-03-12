document.addEventListener("DOMContentLoaded", () => {
  // --- Header / navigation interactions ---
  document.addEventListener("click", (e) => {
    const toggle = e.target.closest(".dropdown-toggle");
    if (toggle) {
      e.preventDefault();
      e.stopPropagation();
      const menu = toggle.nextElementSibling;
      if (menu) menu.classList.toggle("show");
      return;
    }

    document.querySelectorAll(".dropdown-menu.show").forEach((menu) => menu.classList.remove("show"));
  });

  const hamburger = document.getElementById("hamburger");
  const navList = document.querySelector(".nav-list");
  const toggleNav = () => {
    if (!hamburger || !navList) return;
    navList.classList.toggle("active");
    hamburger.classList.toggle("active");
  };

  if (hamburger && navList) {
    hamburger.addEventListener("click", toggleNav);
    hamburger.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") toggleNav();
    });
  }

  // --- Carousel logic ---
  const slidesContainer = document.getElementById("slides");
  const nextBtn = document.getElementById("next");
  const prevBtn = document.getElementById("prev");
  const dotsContainer = document.querySelector(".carousel-dots");

  if (slidesContainer && nextBtn && prevBtn && dotsContainer) {
    const originalSlides = Array.from(slidesContainer.children);
    const totalOriginalSlides = originalSlides.length;

    if (totalOriginalSlides < 3) {
      console.warn("Carousel requires at least 3 slides to function.");
      return;
    }

    const firstClone = originalSlides[0].cloneNode(true);
    const lastClone = originalSlides[totalOriginalSlides - 1].cloneNode(true);
    slidesContainer.appendChild(firstClone);
    slidesContainer.insertBefore(lastClone, originalSlides[0]);

    const slides = Array.from(slidesContainer.children);
    const totalSlides = slides.length;

    let currentIndex = 1;
    let isTransitioning = false;

    slidesContainer.style.transition = "none";
    slidesContainer.style.transform = `translateX(-${currentIndex * 33.333}%)`;

    const getTransform = (index) => -index * 33.333;

    dotsContainer.innerHTML = originalSlides
      .map((_, i) => `<span class="dot${i === 0 ? " active" : ""}" data-slide="${i}"></span>`)
      .join("");
    const dots = dotsContainer.querySelectorAll(".dot");

    function updateSlideClasses() {
      slides.forEach((slide) => slide.classList.remove("active", "prev", "next"));

      const activeSlide = slides[currentIndex];
      if (activeSlide) activeSlide.classList.add("active");

      const prevSlide = slides[currentIndex - 1];
      if (prevSlide) prevSlide.classList.add("prev");

      const nextSlide = slides[currentIndex + 1];
      if (nextSlide) nextSlide.classList.add("next");

      const originalIndex = (currentIndex - 1 + totalOriginalSlides) % totalOriginalSlides;
      dots.forEach((dot, i) => dot.classList.toggle("active", i === originalIndex));
    }

    function moveToSlide(index) {
      if (isTransitioning) return;
      isTransitioning = true;

      slidesContainer.style.transition = "transform 0.5s ease-in-out";
      currentIndex = index;
      slidesContainer.style.transform = `translateX(${getTransform(currentIndex)}%)`;
      updateSlideClasses();
    }

    slidesContainer.addEventListener("transitionend", () => {
      isTransitioning = false;

      if (currentIndex === totalSlides - 1) {
        slidesContainer.style.transition = "none";
        currentIndex = 1;
        slidesContainer.style.transform = `translateX(${getTransform(currentIndex)}%)`;
      } else if (currentIndex === 0) {
        slidesContainer.style.transition = "none";
        currentIndex = totalOriginalSlides;
        slidesContainer.style.transform = `translateX(${getTransform(currentIndex)}%)`;
      }
    });

    nextBtn.addEventListener("click", () => moveToSlide(currentIndex + 1));
    prevBtn.addEventListener("click", () => moveToSlide(currentIndex - 1));

    dots.forEach((dot, i) => dot.addEventListener("click", () => moveToSlide(i + 1)));

    let autoplayInterval;
    const startAutoplay = () => {
      autoplayInterval = setTimeout(() => {
        moveToSlide(currentIndex + 1);
        startAutoplay();
      }, 10000);
    };
    const stopAutoplay = () => clearTimeout(autoplayInterval);

    document.addEventListener("visibilitychange", () => (document.hidden ? stopAutoplay() : startAutoplay()));

    updateSlideClasses();
    startAutoplay();
  }

  // --- Initialize code containers ---
  document.querySelectorAll(".code-container").forEach((container) => {
    if (!container.style.maxHeight) container.style.maxHeight = "300px";
  });

  // --- Gallery / lightbox ---
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const downloadBtn = document.getElementById("lightbox-download");
  const closeBtn = document.querySelector(".lightbox-close");
  const galleryImages = document.querySelectorAll(".gallery-item img");

  if (lightbox && lightboxImg && downloadBtn && closeBtn && galleryImages.length > 0) {
    galleryImages.forEach((img) => {
      img.addEventListener("click", () => {
        lightboxImg.src = img.src;
        downloadBtn.href = img.src;
        lightbox.classList.add("show");
        lightbox.setAttribute("aria-hidden", "false");
      });
    });

    closeBtn.addEventListener("click", () => {
      lightbox.classList.remove("show");
      lightbox.setAttribute("aria-hidden", "true");
    });

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        lightbox.classList.remove("show");
        lightbox.setAttribute("aria-hidden", "true");
      }
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && lightbox.classList.contains("show")) {
        lightbox.classList.remove("show");
        lightbox.setAttribute("aria-hidden", "true");
      }
    });
  }
});

// --- Code toggle helper (used by milestone pages) ---
function toggleCode(wrapperId) {
  const wrapper = document.getElementById(wrapperId);
  if (!wrapper) return;

  const container = wrapper.querySelector(".code-container");
  const button = wrapper.querySelector(".code-toggle");
  if (!container || !button) return;

  if (container.style.maxHeight === "300px") {
    container.style.maxHeight = "none";
    button.textContent = "Contraer";
    wrapper.classList.add("expanded");
  } else {
    container.style.maxHeight = "300px";
    button.textContent = "Expandir";
    wrapper.classList.remove("expanded");
  }
}