<link rel="stylesheet" href="../../../public/css/home.css">
<script src="/js/scroll.js"></script>

<script src="/public/js/scroll.js"></script>

<section id="hero" class="hero">
  <p class="ps">Selamat Datang di</p>
  <h1>POSYANDU MAWAR MANIS</h1>
  <p>Digitalisasi pelayanan Posyandu secara Paperless,
    Online & Terintegrasi dengan Puskesmas,
    Dinas Kesehatan Kota/Kabupaten.</p>
  <img src="/public/img/hero2.png" alt="Gambar Posyandu">
</section>

<section id="about" class="about">
  <div class="about-content">
    <div class="about-text hidden">
      <p class="head">Tentang <span class="psn">Posyandu</span></p>
      <p>
        Posyandu adalah singkatan dari Pos Pelayanan Terpadu, yang merupakan salah satu bentuk pelayanan kesehatan
        masyarakat di Indonesia.
        Posyandu bertujuan untuk meningkatkan kesehatan ibu dan anak, serta memberikan pelayanan kesehatan dasar kepada
        masyarakat.
        Posyandu biasanya dikelola oleh masyarakat setempat dengan dukungan dari tenaga kesehatan, seperti bidan atau
        perawat.
      </p>
    </div>
    <div class="about-img hidden">
      <img src="/public/img/about.png" alt="Gambar Posyandu">
    </div>
  </div>
</section>

<section id="blog" class="blog-section">
  <div class="container">
    <div class="header">
      <h4 class="subtitle">Artikel</h4>
      <h2 class="title">Artikel Kesehatan</h2>
      <p class="description">
        Temukan berbagai informasi penting seputar kesehatan untuk hidup lebih baik dan bugar setiap hari.
      </p>
    </div>

    <div class="card-wrapper">
      <!-- Card 1 -->
      <div class="card">
        <img src="/public/img/posyanduA.jpg" alt="posyanduA" />
        <div class="card-content">
          <h3><a href="#">Posyandu</a></h3>
          <p>
            Aku anak sehat, tubuhku kuat, berat badanku ditimbang selalu, Posyandu menunggu setiap waktu. Posyandu kini apa kabar ya?
          </p>
          <a href="#" class="btn">Selengkapnya</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <img src="/public/img/ibu_hamil.webp" alt="ibu hamil" />
        <div class="card-content">
          <h3><a href="#">Panduan Ibu Hamil</a></h3>
          <p>
            Ketika berencana untuk hamil, para wanita dianjurkan untuk lebih memperhatikan kesehatannya mulai dari sebelum hamil, selama hamil,
            setelah melahirkan hingga menyusui. Beberapa cara berikut perlu dilakukan untuk membantu menjaga kesehatan ibu hamil, antara lain:
          </p>
          <a href="https://www.halodoc.com/kesehatan/kesehatan-ibu-hamil" class="btn">Selengkapnya</a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <img src="/public/img/balita.jpg" alt="balita" />
        <div class="card-content">
          <h3><a href="#">Gizi Balita</a></h3>
          <p>
            Gizi memiliki peran penting dalam proses tumbuh kembang anak balita. Jika kebutuhan gizi balita tidak terpenuhi dengan baik,
            hal ini akan dapat membuat pertumbuhan dan perkembangannya terganggu dan dampaknya mungkin akan terlihat hingga ia dewasa.
          </p>
          <a href="#" class="btn">Selengkapnya</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
<div class="container-contact">
  <div class="contact-section">
    <div class="contact-form">
      <h2>Form Kontak</h2>
      <form>
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" placeholder="Masukkan nama kamu...">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="contoh@email.com">

        <label for="subject">Subjek</label>
        <input type="text" id="subject" name="subject" placeholder="Judul pesan kamu...">

        <label for="message">Pesan</label>
        <textarea id="message" name="message" rows="6" placeholder="Tulis pesan kamu di sini..."></textarea>

        <button type="submit">Kirim Pesan 🚀</button>
      </form>
    </div>

    <div class="contact-info">
      <h3>Informasi</h3>
      <p>📍 Alamat: Jl. Blok Pahing Rt:08 Rw:02</p>

      <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3130.005741901981!2d108.56766707379184!3d-6.9851206684022324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwNTknMDYuNSJTIDEwOMKwMzQnMTIuOSJF!5e1!3m2!1sid!2sid!4v1746264868348!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    </div>
  </div>

</div>
</section>
<script>
  const hiddenElements = document.querySelectorAll('.hidden');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        entry.target.classList.remove('hidden');
      }
    });
  });

  hiddenElements.forEach((el) => observer.observe(el));
  window.addEventListener("scroll", function () {
      const body = document.body;
      if (window.scrollY > 50) {
        body.classList.add("scrolled");
      } else {
        body.classList.remove("scrolled");
      }
    });
</script>