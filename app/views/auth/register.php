<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['judul'] ?? 'Register'; ?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/reg.css">
</head>

<body>

  <a href="<?= BASEURL; ?>/home" class="back-button">← Kembali ke Home</a>
  <div class="container">
    <div class="title"><?= $data['judul'] ?? 'Register'; ?></div>

    <?php if (!empty($data['pesan'])): ?>
      <div class="pesan-flash <?= $data['pesan_tipe']; ?>">
        <?= $data['pesan']; ?>
      </div>
    <?php endif; ?>

    <div class="content">
      <form action="<?= BASEURL; ?>/auth/prosesRegistrasi" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">NIK</span>
            <input type="text" id="NIK" name="NIK" maxlength="16" placeholder="Masukkan NIK" required
              value="<?= $data['form_data']['NIK'] ?? ''; ?>">
          </div>
          <div class="input-box">
            <span class="details">Nama Lengkap</span>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
              value="<?= $data['form_data']['nama'] ?? ''; ?>">
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
          </div>
          <div class="input-box">
            <span class="details">Umur</span>
            <input type="number" id="umur" name="umur" placeholder="Masukkan umur" required
              value="<?= $data['form_data']['umur'] ?? ''; ?>">
          </div>
          <div class="input-box">
            <span class="details">Alamat</span>
            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required
              value="<?= $data['form_data']['alamat'] ?? ''; ?>">
          </div>
        </div>

        <div class="gender-details">
          <span class="gender-title">Jenis Kelamin</span>
          <div class="category">
            <label for="dot-1">
              <input type="radio" name="gender" id="dot-1" value="Laki-Laki" required
                <?= (isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'Laki-Laki') ? 'checked' : ''; ?>>
              <span class="dot one"></span>
              <span class="gender">Laki-Laki</span>
            </label>
            <label for="dot-2">
              <input type="radio" name="gender" id="dot-2" value="Perempuan"
                <?= (isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'Perempuan') ? 'checked' : ''; ?>>
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