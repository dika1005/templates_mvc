function openModal(imgSrc, title) {
  document.getElementById("imageModal").style.display = "block";
  document.getElementById("modalImg").src = "uploads/" + imgSrc;
  document.getElementById("caption").innerText = title;
}

function closeModal() {
  document.getElementById("imageModal").style.display = "none";
}
