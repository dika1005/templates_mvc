document.addEventListener("DOMContentLoaded", () => {
    // Fade-in animation
    const fadeEl = document.querySelector('.fade-in-up');
    if (fadeEl) {
      setTimeout(() => fadeEl.classList.add('show'), 100);
    }
  
    // Info menarik berganti
    const infoList = [
      "👶 Bayi yang mendapatkan imunisasi lengkap lebih terlindungi dari penyakit serius.",
      "🥗 Asupan gizi seimbang penting untuk tumbuh kembang balita.",
      "💧 Pastikan anak cukup minum air putih setiap hari.",
      "🏃 Aktivitas fisik seperti bermain membantu perkembangan motorik anak.",
      "🩺 Pemeriksaan rutin di Posyandu mendeteksi gangguan kesehatan lebih dini."
    ];
  
    const infoBox = document.getElementById("infoBox");
    let current = 0;
  
    function showNextInfo() {
      if (infoBox) {
        infoBox.textContent = infoList[current];
        current = (current + 1) % infoList.length;
      }
    }
  
    showNextInfo();
    setInterval(showNextInfo, 5000);
  
    // Progress Circle
    const progressCircle = document.querySelector('.progress-circle');
    let progress = 66; // Ubah ini sesuai data aktual
  
    function updateProgress() {
      if (progressCircle) {
        progressCircle.style.background = `conic-gradient(#00aaff 0% ${progress}%, #dceeff ${progress}% 100%)`;
        progressCircle.textContent = `${progress}%`;
      }
    }
  
    updateProgress();
  });
  