// Wait until the DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {

  // =============================
  // GLOBAL DROPDOWN CLICK HANDLER
  // =============================
  document.addEventListener("click", (e) => {
    const toggle = e.target.closest(".dropdown-toggle");

    if (toggle) {
      // Prevent default link behavior and stop bubbling
      e.preventDefault();
      e.stopPropagation();

      const menu = toggle.nextElementSibling;
      if (menu) menu.classList.toggle("show"); // Show/hide the dropdown menu

      // Update aria-expanded for accessibility
      const expanded = toggle.getAttribute("aria-expanded") === "true";
      toggle.setAttribute("aria-expanded", String(!expanded));
      return;
    }

    // Close all dropdowns if clicked outside
    document.querySelectorAll(".dropdown-menu.show").forEach((menu) => menu.classList.remove("show"));
    document.querySelectorAll('.dropdown-toggle[aria-expanded="true"]').forEach((btn) => btn.setAttribute("aria-expanded", "false"));
  });

  // =============================
  // HAMBURGER MENU TOGGLE
  // =============================
  const hamburger = document.getElementById('hamburger');
  const navList = document.querySelector('.nav-list');

  hamburger?.addEventListener('click', () => {
    const open = navList.classList.toggle('active'); // Show/hide nav
    hamburger.classList.toggle('active', open);      // Animate hamburger
    hamburger.setAttribute('aria-expanded', open);   // Accessibility
  });

  // =============================
  // NAV DROPDOWN (USER BUTTON)
  // =============================
  document.querySelectorAll('.nav-dropdown').forEach(dropdown => {
    const toggle = dropdown.querySelector('.dropdown-toggle');
    const menu = dropdown.querySelector('.dropdown-menu');

    toggle?.addEventListener('click', (e) => {
      e.stopPropagation();                  // Prevent closing global handler
      const open = menu.classList.toggle('show'); // Toggle menu visibility
      toggle.setAttribute('aria-expanded', open);
    });
  });

  // =============================
  // CLOSE DROPDOWNS WHEN CLICKING OUTSIDE
  // =============================
  document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
      menu.classList.remove('show');
      menu.closest('.nav-dropdown')
          ?.querySelector('.dropdown-toggle')
          ?.setAttribute('aria-expanded', 'false');
    });
  });

  // =============================
  // CODE BLOCK COLLAPSING / EXPANDING
  // =============================
  document.querySelectorAll(".code-container").forEach((container) => {
    // Set default collapsed height
    if (!container.style.maxHeight) container.style.maxHeight = "300px";
  });

  document.addEventListener("click", (event) => {
    const button = event.target.closest(".code-toggle");
    if (!button) return;

    // Determine the container to expand/collapse
    const wrapperId = button.dataset.codeTarget;
    const wrapper = wrapperId ? document.getElementById(wrapperId) : button.closest(".code-wrapper");
    if (!wrapper) return;

    const container = wrapper.querySelector(".code-container");
    if (!container) return;

    // Toggle max-height to expand/collapse code
    const isExpanded = container.style.maxHeight === "none";
    container.style.maxHeight = isExpanded ? "300px" : "none";
    button.textContent = isExpanded ? (button.dataset.labelExpand || "Expand") : (button.dataset.labelCollapse || "Collapse");
    wrapper.classList.toggle("expanded", !isExpanded);
  });

  // =============================
  // LIGHTBOX GALLERY
  // =============================
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const downloadBtn = document.getElementById("lightbox-download");
  const closeBtn = document.querySelector(".lightbox-close");
  const galleryImages = document.querySelectorAll(".gallery-item img");

  if (lightbox && lightboxImg && downloadBtn && closeBtn && galleryImages.length > 0) {
    // Open lightbox when clicking a gallery image
    galleryImages.forEach((img) => {
      img.addEventListener("click", () => {
        lightboxImg.src = img.src;
        downloadBtn.href = img.src;
        lightbox.classList.add("show");
        lightbox.setAttribute("aria-hidden", "false");
      });
    });

    // Close lightbox on close button click
    closeBtn.addEventListener("click", () => {
      lightbox.classList.remove("show");
      lightbox.setAttribute("aria-hidden", "true");
    });

    // Close lightbox when clicking outside the image
    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        lightbox.classList.remove("show");
        lightbox.setAttribute("aria-hidden", "true");
      }
    });

    // Close lightbox on Escape key press
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && lightbox.classList.contains("show")) {
        lightbox.classList.remove("show");
        lightbox.setAttribute("aria-hidden", "true");
      }
    });
  }
});