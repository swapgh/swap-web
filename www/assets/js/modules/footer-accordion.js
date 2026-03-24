window.Swap = window.Swap || {};
window.Swap.footerAccordion = (() => {
  const mobileQuery = window.matchMedia("(max-width: 560px)");
  let listenersBound = false;

  const setSectionState = (section, expanded) => {
    const toggle = section.querySelector(".footer-section-toggle");
    const panel = section.querySelector("[data-footer-panel]");
    if (!toggle || !panel) return;

    toggle.setAttribute("aria-expanded", String(expanded));
    panel.hidden = !expanded;
    section.classList.toggle("is-open", expanded);
  };

  const syncLayout = (sections) => {
    const isMobile = mobileQuery.matches;

    sections.forEach((section) => {
      const toggle = section.querySelector(".footer-section-toggle");
      const panel = section.querySelector("[data-footer-panel]");
      const defaultOpen = section.hasAttribute("data-footer-default-open");
      if (!toggle || !panel) return;

      if (!isMobile) {
        toggle.setAttribute("aria-expanded", "true");
        panel.hidden = false;
        section.classList.remove("is-open");
        return;
      }

      setSectionState(section, defaultOpen);
    });
  };

  const bindSections = (sections) => {
    sections.forEach((section) => {
      const toggle = section.querySelector(".footer-section-toggle");
      if (!toggle || toggle.dataset.bound === "true") return;

      toggle.dataset.bound = "true";
      toggle.addEventListener("click", () => {
        if (!mobileQuery.matches) return;
        const expanded = toggle.getAttribute("aria-expanded") === "true";
        setSectionState(section, !expanded);
      });
    });
  };

  const init = () => {
    const sections = Array.from(document.querySelectorAll("[data-footer-section]"));
    if (!sections.length) return;

    bindSections(sections);
    syncLayout(sections);

    if (!listenersBound) {
      const handleChange = () => syncLayout(sections);
      if (typeof mobileQuery.addEventListener === "function") {
        mobileQuery.addEventListener("change", handleChange);
      } else if (typeof mobileQuery.addListener === "function") {
        mobileQuery.addListener(handleChange);
      }
      listenersBound = true;
    }
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init, { once: true });
  } else {
    init();
  }

  return { init };
})();
