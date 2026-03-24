window.Swap = window.Swap || {};
window.Swap.dropdowns = (() => {
  const closeAll = () => {
    document.querySelectorAll(".dropdown-menu.show").forEach((menu) => menu.classList.remove("show"));
    document.querySelectorAll('.dropdown-toggle[aria-expanded="true"]').forEach((btn) => btn.setAttribute("aria-expanded", "false"));
  };

  const init = () => {
    document.addEventListener("click", (event) => {
      const toggle = event.target.closest(".dropdown-toggle");

      if (toggle) {
        event.preventDefault();
        event.stopPropagation();

        const menu = toggle.nextElementSibling;
        const willOpen = menu && !menu.classList.contains("show");

        closeAll();

        if (menu && willOpen) {
          menu.classList.add("show");
          toggle.setAttribute("aria-expanded", "true");
        }
        return;
      }

      closeAll();
    });
  };

  return { init };
})();
