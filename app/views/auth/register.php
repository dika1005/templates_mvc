<?php
// File: app/views/auth/register.php
// Variabel $data dikirim dari method Auth::register()
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($data['judul'] ?? 'Register'); ?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/reg.css">
  <style>
    /* Style untuk pesan notifikasi (bisa dipindah ke reg.css jika sering dipakai) */
    .pesan-flash {
      padding: 15px;
      margin: 20px 0;
      border: 1px solid transparent;
      border-radius: 5px;
      font-weight: bold;
      text-align: center;
    }

    .pesan-flash.sukses {
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
    }

    .pesan-flash.error {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="title"><?= htmlspecialchars($data['judul'] ?? 'Register'); ?></div>

    <?php if (!empty($data['pesan'])): ?>
      <div class="pesan-flash <?= htmlspecialchars($data['pesan_tipe']); ?>">
        <?= $data['pesan']; /* Pesan sudah di-escape di controller atau bisa di-escape di sini jika perlu */ ?>
      </div>
    <?php endif; ?>

    <div class="content">
      <form action="<?= BASEURL; ?>/auth/prosesRegistrasi" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">NIK</span>
            <input type="text" id="NIK" name="NIK" placeholder="Masukkan NIK" required
              value="<?= htmlspecialchars($data['form_data']['NIK'] ?? ''); ?>">
          </div>
          <div class="input-box">
            <span class="details">Nama Lengkap</span>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
              value="<?= htmlspecialchars($data['form_data']['nama'] ?? ''); ?>">
          </div>
          <div class="input-box">
            <span class="details">Umur</span>
            <input type="number" id="umur" name="umur" placeholder="Masukkan umur" required
              value="<?= htmlspecialchars($data['form_data']['umur'] ?? ''); ?>">
          </div>
          <div class="input-box">
            <span class="details">Alamat</span>
            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required
              value="<?= htmlspecialchars($data['form_data']['alamat'] ?? ''); ?>">
          </div>
        </div>

        <div class="gender-details">
          <span class="gender-title">Jenis Kelamin</span>
          <input type="radio" name="gender" id="dot-1" value="Laki-Laki" required
            <?= (isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'Laki-Laki') ? 'checked' : ''; ?>>
          <input type="radio" name="gender" id="dot-2" value="Perempuan"
            <?= (isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'Perempuan') ? 'checked' : ''; ?>>

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