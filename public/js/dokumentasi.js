  document.addEventListener("DOMContentLoaded", function () {
    const images = Array.from(document.querySelectorAll(".galeri-item img"));
    let currentIndex = 0;

    images.forEach((img, index) => {
      if (img.complete) {
        checkOrientationAndAddClass(img);
      } else {
        img.addEventListener("load", () => checkOrientationAndAddClass(img));
      }
      img.addEventListener("error", () => {
        console.error("Gagal memuat gambar:", img.src);
      });

      // Pasang click event untuk buka modal dan simpan index
      img.addEventListener("click", () => {
        currentIndex = index;
        openModal(images[currentIndex].src);
        renderThumbnails();
      });
    });

    function checkOrientationAndAddClass(img) {
      const naturalWidth = img.naturalWidth;
      const naturalHeight = img.naturalHeight;

      if (naturalHeight > naturalWidth + 1) {
        img.classList.add("portrait");
      } else {
        img.classList.add("landscape");
      }
    }

    // Fungsi buat tampilkan gambar sesuai index sekarang
    function showImageAtIndex(index) {
      if (index < 0) index = images.length - 1;
      if (index >= images.length) index = 0;
      currentIndex = index;
      const modalImage = document.getElementById("modalImage");
      modalImage.src = images[currentIndex].src;

      // Update download link juga
      const downloadLink = document.getElementById("downloadImage");
      if (downloadLink) {
        downloadLink.href = modalImage.src;
        downloadLink.setAttribute("download", "");
      }

      highlightActiveThumbnail();
    }

    // Buat render thumbnails di modal
    function renderThumbnails() {
      const thumbnailsContainer = document.getElementById("modalThumbnails");
      thumbnailsContainer.innerHTML = "";
      images.forEach((img, i) => {
        const thumb = document.createElement("img");
        thumb.src = img.src;
        thumb.classList.add("thumbnail");
        if (i === currentIndex) thumb.classList.add("active");
        thumb.addEventListener("click", () => showImageAtIndex(i));
        thumbnailsContainer.appendChild(thumb);
      });
    }

    function highlightActiveThumbnail() {
      const thumbnails = document.querySelectorAll("#modalThumbnails img");
      thumbnails.forEach((thumb, i) => {
        thumb.classList.toggle("active", i === currentIndex);
      });
    }

    // Update fungsi openModal supaya pakai showImageAtIndex
    window.openModal = function (src) {
      const modal = document.getElementById("imageModal");
      modal.style.display = "block";
      document.body.classList.add("modal-open");

      // Set currentIndex dari src supaya gambar sesuai yang diklik
      const index = images.findIndex((img) => img.src === src);
      if (index !== -1) {
        currentIndex = index;
      }

      // Show image berdasarkan currentIndex
      showImageAtIndex(currentIndex);

      // Render thumbnails tiap buka modal
      renderThumbnails();
    };

    // Tombol navigasi
    document.getElementById("prevBtn").addEventListener("click", () => {
      showImageAtIndex(currentIndex - 1);
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
      showImageAtIndex(currentIndex + 1);
    });

    // Fungsi close modal yang sudah diperbaiki
    window.closeModal = function (event) {
      if (event && event.target && event.target.id === "modalImage") {
        return;
      }
      if (
        event &&
        event.target &&
        event.target.classList.contains("modal-header-actions")
      ) {
        return;
      }
      if (
        event &&
        event.target &&
        (event.target.classList.contains("close") ||
          event.target.classList.contains("modal"))
      ) {
        const modal = document.getElementById("imageModal");
        const modalImage = document.getElementById("modalImage");
        modal.style.display = "none";
        modalImage.src = "";
        if (document.getElementById("downloadImage")) {
          document.getElementById("downloadImage").href = "#";
          document.getElementById("downloadImage").removeAttribute("download");
        }
        document.body.classList.remove("modal-open");
      } else {
        return;
      }
    };

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        closeModal();
      }
    });

    // Tombol copy link
    const copyLinkButton = document.getElementById("copyLink");
    if (copyLinkButton) {
      copyLinkButton.addEventListener("click", function () {
        const imageUrl = document.getElementById("modalImage").src;
        if (imageUrl) {
          navigator.clipboard
            .writeText(imageUrl)
            .then(function () {
              const originalTitle = copyLinkButton.getAttribute("title");
              copyLinkButton.textContent = "Copied!";
              copyLinkButton.removeAttribute("title");
              setTimeout(() => {
                copyLinkButton.innerHTML = "&#x2398;";
                copyLinkButton.setAttribute("title", originalTitle);
              }, 2000);
            })
            .catch(function (err) {
              console.error("Failed to copy image URL: ", err);
              const originalTitle = copyLinkButton.getAttribute("title");
              copyLinkButton.textContent = "Failed!";
              copyLinkButton.removeAttribute("title");
              setTimeout(() => {
                copyLinkButton.innerHTML = "&#x2398;";
                copyLinkButton.setAttribute("title", originalTitle);
              }, 2000);
            });
        }
      });
    }

    // Tombol download di-handle manual supaya base64 bisa didownload
    const downloadButton = document.getElementById("downloadImage");
    if (downloadButton) {
      downloadButton.addEventListener("click", function (e) {
        e.preventDefault();
        const imageUrl = document.getElementById("modalImage").src;
        if (!imageUrl) return;

        const link = document.createElement("a");
        link.href = imageUrl;
        // Ganti nama file sesuai kebutuhan
        link.download = "downloaded_image.png";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });
    }
  });

  // Style modal-open supaya body gak bisa scroll pas modal aktif
  const style = document.createElement("style");
  style.innerHTML = `
    .modal-open {
      overflow: hidden;
    }
  `;
  document.head.appendChild(style);
