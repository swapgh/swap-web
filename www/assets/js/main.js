// Wait until the DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
  const allowedThemes = ["classic", "moon", "mist", "forest", "light"];
  const consentCookieName = "swap_cookie_consent";
  const themeColorMap = {
    moon: "#0b0d10",
    classic: "#0a1220",
    mist: "#0b1118",
    forest: "#0c1412",
    light: "#f2f5f8",
  };

  const applyTheme = (theme) => {
    const safeTheme = allowedThemes.includes(theme) ? theme : "classic";
    document.documentElement.dataset.theme = safeTheme;
    document.documentElement.style.colorScheme = safeTheme === "light" ? "light" : "dark";
    window.localStorage.setItem("swap-theme", safeTheme);

    const themeMeta = document.querySelector('meta[name="theme-color"]');
    if (themeMeta) {
      themeMeta.setAttribute("content", themeColorMap[safeTheme] || themeColorMap.classic);
    }

    document.querySelectorAll(".theme-option").forEach((button) => {
      const isActive = button.dataset.themeValue === safeTheme;
      button.classList.toggle("active", isActive);
      button.setAttribute("aria-pressed", String(isActive));
    });
  };

  applyTheme(document.documentElement.dataset.theme || "classic");

  const readCookie = (name) => {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
      return parts.pop().split(";").shift() || "";
    }
    return "";
  };

  const writeCookie = (name, value, days = 180) => {
    const expires = new Date(Date.now() + days * 86400000).toUTCString();
    const secureFlag = window.location.protocol === "https:" ? "; Secure" : "";
    document.cookie = `${name}=${value}; expires=${expires}; path=/; SameSite=Lax${secureFlag}`;
  };

  const getConsentRecord = () => {
    const localValue = window.localStorage.getItem(consentCookieName);
    if (localValue) {
      try {
        return JSON.parse(localValue);
      } catch (_) {
        window.localStorage.removeItem(consentCookieName);
      }
    }

    const cookieValue = readCookie(consentCookieName);
    if (!cookieValue) {
      return null;
    }

    try {
      return JSON.parse(decodeURIComponent(cookieValue));
    } catch (_) {
      return null;
    }
  };

  const setConsentRecord = (choice) => {
    const record = {
      choice,
      updated_at: new Date().toISOString(),
      source: "banner",
    };

    const serialized = JSON.stringify(record);
    window.localStorage.setItem(consentCookieName, serialized);
    writeCookie(consentCookieName, encodeURIComponent(serialized));
    document.documentElement.dataset.cookieConsent = choice;
    return record;
  };

  const banner = document.getElementById("cookie-banner");
  const consentRecord = getConsentRecord();
  if (consentRecord?.choice) {
    document.documentElement.dataset.cookieConsent = consentRecord.choice;
  } else if (banner) {
    banner.hidden = false;
  }

  document.querySelectorAll("[data-cookie-consent]").forEach((button) => {
    button.addEventListener("click", () => {
      const choice = button.getAttribute("data-cookie-consent") || "essential";
      setConsentRecord(choice);
      if (banner) {
        banner.hidden = true;
      }
    });
  });

  // =============================
  // GLOBAL DROPDOWN CLICK HANDLER
  // =============================
  const closeAllDropdowns = () => {
    document.querySelectorAll(".dropdown-menu.show").forEach((menu) => menu.classList.remove("show"));
    document.querySelectorAll('.dropdown-toggle[aria-expanded="true"]').forEach((btn) => btn.setAttribute("aria-expanded", "false"));
  };

  document.addEventListener("click", (e) => {
    const toggle = e.target.closest(".dropdown-toggle");

    if (toggle) {
      e.preventDefault();
      e.stopPropagation();

      const menu = toggle.nextElementSibling;
      const willOpen = menu && !menu.classList.contains("show");

      closeAllDropdowns();

      if (menu && willOpen) {
        menu.classList.add("show");
        toggle.setAttribute("aria-expanded", "true");
      }
      return;
    }

    closeAllDropdowns();
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
  // THEME SWITCHER
  // =============================
  document.querySelectorAll(".theme-option").forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault();
      applyTheme(button.dataset.themeValue || "classic");
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
