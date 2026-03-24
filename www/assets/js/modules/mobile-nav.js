window.Swap = window.Swap || {};
window.Swap.mobileNav = (() => {
  const init = () => {
    const hamburger = document.getElementById("hamburger");
    const navList = document.querySelector(".nav-list");

    hamburger?.addEventListener("click", () => {
      if (!navList) return;
      const open = navList.classList.toggle("active");
      hamburger.classList.toggle("active", open);
      hamburger.setAttribute("aria-expanded", String(open));
    });
  };

  return { init };
})();
