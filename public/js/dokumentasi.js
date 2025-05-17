document.addEventListener("DOMContentLoaded", function () {
  const images = document.querySelectorAll(".galeri-item img");
  images.forEach((img) => {
    if (img.complete) {
      checkOrientationAndAddClass(img);
    } else {
      img.addEventListener("load", () => checkOrientationAndAddClass(img));
    }
    img.addEventListener("error", () => {
      console.error("Gagal memuat gambar:", img.src);
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
});

function openModal(src) {
  const modal = document.getElementById("imageModal");
  const modalImage = document.getElementById("modalImage");
  const downloadLink = modal.querySelector("#downloadImage");

  modalImage.src = src;

  if (downloadLink) {
    downloadLink.href = src;
    downloadLink.setAttribute("download", "");
  }

  modal.style.display = "block";
  document.body.classList.add("modal-open");
}

function closeModal(event) {
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
  } else {
    return;
  }

  const modal = document.getElementById("imageModal");
  const modalImage = document.getElementById("modalImage");
  modal.style.display = "none";
  modalImage.src = "";
  if (document.getElementById("downloadImage")) {
    document.getElementById("downloadImage").href = "#";
    document.getElementById("downloadImage").removeAttribute("download");
  }
  document.body.classList.remove("modal-open");
}

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    closeModal();
  }
});

const style = document.createElement("style");
style.innerHTML = `
            .modal-open {
                overflow: hidden;
            }
        `;
document.head.appendChild(style);
