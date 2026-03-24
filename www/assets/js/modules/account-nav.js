(() => {
  const normalizeRoute = (value) => {
    const trimmed = (value || "").replace(/\/+$/, "");
    if (!trimmed) {
      return "/";
    }

    return trimmed.startsWith("/") ? trimmed : `/${trimmed}`;
  };

  const getCurrentAccountRoute = () => {
    const url = new URL(window.location.href);
    const routeParam = url.searchParams.get("route");

    if (routeParam) {
      return normalizeRoute(routeParam);
    }

    return normalizeRoute(url.pathname);
  };

  const updateAccountNav = () => {
    const nav = document.querySelector("[data-account-nav]");
    if (!nav) {
      return;
    }

    const links = Array.from(nav.querySelectorAll("[data-account-nav-key]"));
    if (links.length === 0) {
      return;
    }

    const route = getCurrentAccountRoute();
    const hash = window.location.hash;
    let activeKey = null;

    if (route === "/account") {
      activeKey = hash === "#support-area" ? "support" : "dashboard";
    } else if (route === "/account/characters") {
      activeKey = "characters";
    } else if (route === "/account/support/history") {
      activeKey = "history";
    }

    links.forEach((link) => {
      const isActive = link.dataset.accountNavKey === activeKey;
      link.classList.toggle("is-active", isActive);
      if (isActive) {
        link.setAttribute("aria-current", "page");
      } else {
        link.removeAttribute("aria-current");
      }
    });
  };

  const init = () => {
    updateAccountNav();
    window.addEventListener("hashchange", updateAccountNav);
  };

  window.Swap = window.Swap || {};
  window.Swap.accountNav = { init };
})();
