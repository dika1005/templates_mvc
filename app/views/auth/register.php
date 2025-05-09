<link rel="stylesheet" href="<?= BASEURL; ?>/css/reg.css">

<div class="container">
  <div class="title">
    Form Registrasi
  </div>
  <div class="content">
    <form action="<?= BASEURL; ?>/User/tambah" method="post">
      <div class="user-details">
        <div class="input-box">
          <span class="details">NIK</span>
          <input type="text" id="NIK" name="NIK" placeholder="Masukkan NIK" required>
        </div>
        <div class="input-box">
          <span class="details">Nama Lengkap</span>
          <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="input-box">
          <span class="details">Umur</span>
          <input type="text" id="umur" name="umur" placeholder="Masukkan umur" required>
        </div>
        <div class="input-box">
          <span class="details">Tinggi Badan</span>
          <input type="text" id="tinggi" name="tinggi" placeholder="Masukkan tinggi badan" required>
        </div>
        <div class="input-box">
          <span class="details">Berat Badan</span>
          <input type="text" id="berat" name="berat" placeholder="Masukkan berat badan" required>
        </div>
        <div class="input-box">
          <span class="details">Alamat</span>
          <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required>
        </div>
      </div>

      <div class="gender-details">
        <span class="gender-title">Jenis Kelamin</span>
        <input type="radio" name="gender" id="dot-1" value="Laki-Laki">
        <input type="radio" name="gender" id="dot-2" value="Perempuan">

        <div class="category">
          <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Laki-Laki</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Perempuan</span>
          </label>
        </div>
      </div>

      <div class="button">
        <input type="submit" value="Daftar">
      </div>
    </form>
  </div>
</div>