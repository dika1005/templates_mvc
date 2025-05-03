<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Registrasi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="title">
      Form Registrasi
    </div>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">NIK</span>
            <input type="text" placeholder="Masukkan NIK" required>
          </div>
          <div class="input-box">
            <span class="details">Nama Lengkap</span>
            <input type="text" placeholder="Masukkan nama lengkap" required>
          </div>
          <div class="input-box">
            <span class="details">Umur</span>
            <input type="text" placeholder="Masukkan umur" required>
          </div>
          <div class="input-box">
            <span class="details">Tinggi Badan</span>
            <input type="text" placeholder="Masukkan tinggi badan" required>
          </div>
          <div class="input-box">
            <span class="details">Berat Badan</span>
            <input type="text" placeholder="Masukkan berat badan" required>
          </div>
          <div class="input-box">
            <span class="details">Alamat</span>
            <input type="text" placeholder="Masukkan alamat lengkap" required>
          </div>
        </div>

        <div class="gender-details">
          <span class="gender-title">Jenis Kelamin</span>
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">


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
</body>
</html>
