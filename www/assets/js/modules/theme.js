window.Swap = window.Swap || {};
window.Swap.theme = (() => {
  const allowedThemes = ["classic", "moon", "mist", "forest", "light"];
  const themeColorMap = {
    moon: "#0b0d10",
    classic: "#0a1220",
    mist: "#0b1118",
    forest: "#0c1412",
    light: "#f2f5f8",
  };

  const apply = (theme) => {
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

  const init = () => {
    apply(document.documentElement.dataset.theme || "classic");

    document.querySelectorAll(".theme-option").forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        apply(button.dataset.themeValue || "classic");
      });
    });
  };

  return { init, apply };
})();
