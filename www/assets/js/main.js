document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", (e) => {
    const toggle = e.target.closest(".dropdown-toggle");
    if (toggle) {
      e.preventDefault();
      e.stopPropagation();

      const menu = toggle.nextElementSibling;
      if (menu) menu.classList.toggle("show");

      const expanded = toggle.getAttribute("aria-expanded") === "true";
      toggle.setAttribute("aria-expanded", String(!expanded));
      return;
    }

    document.querySelectorAll(".dropdown-menu.show").forEach((menu) => menu.classList.remove("show"));
    document.querySelectorAll(".dropdown-toggle[aria-expanded=\"true\"]").forEach((btn) => btn.setAttribute("aria-expanded", "false"));
  });

  const hamburger = document.getElementById("hamburger");
  const navList = document.querySelector(".nav-list");
  const toggleNav = () => {
    if (!hamburger || !navList) return;
    const willOpen = !navList.classList.contains("active");
    navList.classList.toggle("active");
    hamburger.classList.toggle("active");
    hamburger.setAttribute("aria-expanded", String(willOpen));
  };

  if (hamburger && navList) {
    hamburger.addEventListener("click", toggleNav);
    hamburger.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") toggleNav();
    });

    document.addEventListener("click", (e) => {
      if (!navList.classList.contains("active")) return;
      if (e.target.closest(".nav-list") || e.target.closest("#hamburger")) return;
      toggleNav();
    });
  }

  document.querySelectorAll(".code-container").forEach((container) => {
    if (!container.style.maxHeight) container.style.maxHeight = "300px";
  });

  document.addEventListener("click", (event) => {
    const button = event.target.closest(".code-toggle");
    if (!button) return;

    const wrapperId = button.dataset.codeTarget;
    const wrapper = wrapperId ? document.getElementById(wrapperId) : button.closest(".code-wrapper");
    if (!wrapper) return;

    const container = wrapper.querySelector(".code-container");
    if (!container) return;

    const isExpanded = container.style.maxHeight === "none";
    container.style.maxHeight = isExpanded ? "300px" : "none";
    button.textContent = isExpanded ? (button.dataset.labelExpand || "Expand") : (button.dataset.labelCollapse || "Collapse");
    wrapper.classList.toggle("expanded", !isExpanded);
  });

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
