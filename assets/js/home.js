document.addEventListener("DOMContentLoaded", () => {
  const slides = Array.from(document.querySelectorAll("[data-carousel-slide]"));
  const track = document.querySelector("[data-carousel-track]");
  const prevButton = document.querySelector("[data-carousel-prev]");
  const nextButton = document.querySelector("[data-carousel-next]");
  const dotsRoot = document.querySelector("[data-carousel-dots]");

  if (track && prevButton && nextButton && dotsRoot && slides.length >= 3) {
    const originalSlides = slides.slice();
    const firstClone = originalSlides[0].cloneNode(true);
    const lastClone = originalSlides[originalSlides.length - 1].cloneNode(true);

    track.appendChild(firstClone);
    track.insertBefore(lastClone, originalSlides[0]);

    const carouselSlides = Array.from(track.querySelectorAll("[data-carousel-slide]"));
    let currentIndex = 1;
    let isTransitioning = false;
    let autoplayId = null;

    const dotsMarkup = originalSlides
      .map((_, index) => `<button type="button" class="showcase-dot${index === 0 ? " active" : ""}" data-carousel-dot="${index}" aria-label="Slide ${index + 1}"></button>`)
      .join("");
    dotsRoot.innerHTML = dotsMarkup;
    const dots = Array.from(dotsRoot.querySelectorAll("[data-carousel-dot]"));

    const slideWidth = () => (window.innerWidth <= 1080 ? 100 : 33.333);

    const updateClasses = () => {
      carouselSlides.forEach((slide) => slide.classList.remove("active", "prev", "next"));

      const activeSlide = carouselSlides[currentIndex];
      const prevSlide = carouselSlides[currentIndex - 1];
      const nextSlide = carouselSlides[currentIndex + 1];

      if (activeSlide) activeSlide.classList.add("active");
      if (prevSlide) prevSlide.classList.add("prev");
      if (nextSlide) nextSlide.classList.add("next");

      const originalIndex = (currentIndex - 1 + originalSlides.length) % originalSlides.length;
      dots.forEach((dot, index) => dot.classList.toggle("active", index === originalIndex));
    };

    const applyTransform = () => {
      track.style.transform = `translateX(-${(currentIndex - 1) * slideWidth()}%)`;
    };

    const moveTo = (index) => {
      if (isTransitioning) return;
      isTransitioning = true;
      track.style.transition = "transform 420ms ease";
      currentIndex = index;
      applyTransform();
      updateClasses();
    };

    track.addEventListener("transitionend", () => {
      isTransitioning = false;

      if (currentIndex === carouselSlides.length - 1) {
        track.style.transition = "none";
        currentIndex = 1;
        applyTransform();
        updateClasses();
      } else if (currentIndex === 0) {
        track.style.transition = "none";
        currentIndex = originalSlides.length;
        applyTransform();
        updateClasses();
      }
    });

    const startAutoplay = () => {
      window.clearInterval(autoplayId);
      autoplayId = window.setInterval(() => moveTo(currentIndex + 1), 6000);
    };

    prevButton.addEventListener("click", () => {
      moveTo(currentIndex - 1);
      startAutoplay();
    });

    nextButton.addEventListener("click", () => {
      moveTo(currentIndex + 1);
      startAutoplay();
    });

    dots.forEach((dot) => {
      dot.addEventListener("click", () => {
        moveTo(Number(dot.dataset.carouselDot || "0") + 1);
        startAutoplay();
      });
    });

    window.addEventListener("resize", () => {
      track.style.transition = "none";
      applyTransform();
      updateClasses();
    });

    document.addEventListener("visibilitychange", () => {
      if (document.hidden) {
        window.clearInterval(autoplayId);
      } else {
        startAutoplay();
      }
    });

    track.style.transition = "none";
    applyTransform();
    updateClasses();
    startAutoplay();
  }

  // Platform filter buttons
  const platformButtons = document.querySelectorAll("[data-platform]");
  const platformFilterButtons = document.querySelectorAll(".platform-btn");

  platformFilterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const selectedPlatform = button.dataset.platform || "all";

      // Update active state
      platformFilterButtons.forEach((btn) => btn.classList.toggle("active", btn === button));

      // Filter slides (for now all have data-platform="all", so all are visible)
      platformButtons.forEach((slide) => {
        const slidePlatform = slide.dataset.platform || "all";
        const isVisible = selectedPlatform === "all" || slidePlatform === selectedPlatform || slidePlatform === "all";
        slide.classList.toggle("is-hidden", !isVisible);
      });
    });
  });

  const filterButtons = document.querySelectorAll("[data-filter]");
  const timelineCards = document.querySelectorAll(".timeline-card[data-tag]");

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const selected = button.dataset.filter || "all";

      filterButtons.forEach((chip) => chip.classList.toggle("active", chip === button));
      timelineCards.forEach((card) => {
        const visible = selected === "all" || card.dataset.tag === selected;
        card.classList.toggle("is-hidden", !visible);
      });
    });
  });

  // Make timeline cards clickable
  timelineCards.forEach((card) => {
    card.style.cursor = "pointer";
    card.addEventListener("click", (e) => {
      if (e.target.tagName !== "A") {
        const href = card.dataset.href;
        if (href) {
          window.location.href = href;
        }
      }
    });
  });

  const revealItems = document.querySelectorAll(".reveal-item");
  if (revealItems.length > 0 && "IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    revealItems.forEach((item) => observer.observe(item));
  } else {
    revealItems.forEach((item) => item.classList.add("is-visible"));
  }
});
