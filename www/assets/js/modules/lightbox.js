window.Swap = window.Swap || {};
window.Swap.lightbox = (() => {
  const init = () => {
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const downloadBtn = document.getElementById("lightbox-download");
    const closeBtn = document.querySelector(".lightbox-close");
    const galleryImages = document.querySelectorAll(".gallery-item img");

    if (!lightbox || !lightboxImg || !downloadBtn || !closeBtn || galleryImages.length === 0) {
      return;
    }

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

    lightbox.addEventListener("click", (event) => {
      if (event.target === lightbox) {
        lightbox.classList.remove("show");
        lightbox.setAttribute("aria-hidden", "true");
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && lightbox.classList.contains("show")) {
        lightbox.classList.remove("show");
        lightbox.setAttribute("aria-hidden", "true");
      }
    });
  };

  return { init };
})();
