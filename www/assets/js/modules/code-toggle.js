window.Swap = window.Swap || {};
window.Swap.codeToggle = (() => {
  const init = () => {
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
  };

  return { init };
})();
