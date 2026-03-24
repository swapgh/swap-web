// ==============================================
// Inicializa el carousel de slides
// ==============================================
function initCarousel() {
  // Selección de elementos principales del carousel
  const slides = Array.from(document.querySelectorAll("[data-carousel-slide]"));
  const track = document.querySelector("[data-carousel-track]");
  const prevButton = document.querySelector("[data-carousel-prev]");
  const nextButton = document.querySelector("[data-carousel-next]");
  const dotsRoot = document.querySelector("[data-carousel-dots]");

  // Si falta algún elemento o no hay slides, no se inicializa
  if (!track || !prevButton || !nextButton || !dotsRoot || slides.length === 0) {
    return;
  }

  // Caso de solo un slide: ocultar controles y activar el único slide
  if (slides.length === 1) {
    dotsRoot.innerHTML = "";
    prevButton.hidden = true;
    nextButton.hidden = true;
    slides[0].classList.add("active");
    return;
  }

  // Clonar primer y último slide para efecto infinito
  const originalSlides = slides.slice();
  const firstClone = originalSlides[0].cloneNode(true);
  const lastClone = originalSlides[originalSlides.length - 1].cloneNode(true);

  track.appendChild(firstClone);
  track.insertBefore(lastClone, originalSlides[0]);

  const carouselSlides = Array.from(track.querySelectorAll("[data-carousel-slide]"));
  let currentIndex = 1;           // Empezamos en el primer slide "real"
  let isTransitioning = false;    // Control para no interrumpir transición
  let autoplayId = null;          // ID del autoplay

  // Crear dots de navegación
  dotsRoot.innerHTML = originalSlides
    .map((_, index) => `<button type="button" class="showcase-dot${index === 0 ? " active" : ""}" data-carousel-dot="${index}" aria-label="Slide ${index + 1}"></button>`)
    .join("");

  const dots = Array.from(dotsRoot.querySelectorAll("[data-carousel-dot]"));
  const slideWidth = () => (window.innerWidth <= 1080 ? 100 : 33.333); // porcentaje según ancho de pantalla

  // Actualiza clases "active", "prev", "next" en slides y dots
  const updateClasses = () => {
    carouselSlides.forEach((slide) => slide.classList.remove("active", "prev", "next"));

    carouselSlides[currentIndex]?.classList.add("active");
    carouselSlides[currentIndex - 1]?.classList.add("prev");
    carouselSlides[currentIndex + 1]?.classList.add("next");

    const originalIndex = (currentIndex - 1 + originalSlides.length) % originalSlides.length;
    dots.forEach((dot, index) => dot.classList.toggle("active", index === originalIndex));
  };

  // Aplica la transformación CSS para mover el track
  const applyTransform = () => {
    track.style.transform = `translateX(-${(currentIndex - 1) * slideWidth()}%)`;
  };

  // Mover a un slide específico
  const moveTo = (index) => {
    if (isTransitioning) return;

    isTransitioning = true;
    track.style.transition = "transform 420ms ease";
    currentIndex = index;
    applyTransform();
    updateClasses();
  };

  // Controlar el "loop infinito" al terminar transición
  track.addEventListener("transitionend", () => {
    isTransitioning = false;

    if (currentIndex === carouselSlides.length - 1) {
      track.style.transition = "none";
      currentIndex = 1;
      applyTransform();
      updateClasses();
      return;
    }

    if (currentIndex === 0) {
      track.style.transition = "none";
      currentIndex = originalSlides.length;
      applyTransform();
      updateClasses();
    }
  });

  // Inicia autoplay
  const startAutoplay = () => {
    window.clearInterval(autoplayId);
    autoplayId = window.setInterval(() => moveTo(currentIndex + 1), 6000);
  };

  // Botones de navegación
  prevButton.addEventListener("click", () => {
    moveTo(currentIndex - 1);
    startAutoplay();
  });

  nextButton.addEventListener("click", () => {
    moveTo(currentIndex + 1);
    startAutoplay();
  });

  // Dots de navegación
  dots.forEach((dot) => {
    dot.addEventListener("click", () => {
      moveTo(Number(dot.dataset.carouselDot || "0") + 1);
      startAutoplay();
    });
  });

  // Ajustar tamaño al redimensionar ventana
  window.addEventListener("resize", () => {
    track.style.transition = "none";
    applyTransform();
    updateClasses();
  });

  // Pausar autoplay si la pestaña está oculta
  document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
      window.clearInterval(autoplayId);
      return;
    }
    startAutoplay();
  });

  // Inicialización visual
  track.style.transition = "none";
  applyTransform();
  updateClasses();
  startAutoplay();
}

// ==============================================
// Inicializa los filtros de grupos
// ==============================================
function initFilterGroups() {
  const filterGroups = document.querySelectorAll("[data-filter-group]");

  filterGroups.forEach((group) => {
    const buttons = Array.from(group.querySelectorAll("[data-filter]"));
    const section = group.closest("section");
    const filterItems = Array.from(section?.querySelectorAll("[data-filter-item]") ?? []);

    buttons.forEach((button) => {
      button.addEventListener("click", () => {
        const selected = button.dataset.filter || "all";

        // Activar/desactivar chips
        buttons.forEach((chip) => chip.classList.toggle("active", chip === button));

        // Mostrar/ocultar elementos según filtro
        filterItems.forEach((item) => {
          const tags = (item.dataset.tag || "").split(/\s+/).filter(Boolean);
          const visible = selected === "all" || tags.includes(selected);
          item.classList.toggle("is-hidden", !visible);
        });
      });
    });
  });
}

// ==============================================
// Inicializa animaciones de revelado (fade-in)
// ==============================================
function initRevealItems() {
  const revealItems = document.querySelectorAll(".reveal-item");

  if (revealItems.length === 0) return;

  // Si no hay soporte para IntersectionObserver, mostrar todo
  if (!("IntersectionObserver" in window)) {
    revealItems.forEach((item) => item.classList.add("is-visible"));
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;

      entry.target.classList.add("is-visible");
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.15 });

  revealItems.forEach((item) => observer.observe(item));
}

// ==============================================
// Inicialización al cargar el DOM
// ==============================================
document.addEventListener("DOMContentLoaded", () => {
  initCarousel();
  initFilterGroups();
  initRevealItems();
});