<?php
$message = $data['message'] ?? null;
$displayMessage = null;
$messageType = 'info';

if (is_array($message) && isset($message['isi']) && !empty($message['isi'])) {
  $displayMessage = $message['isi'];
  $messageType = $message['tipe'] ?? 'info';
} else if (is_string($message) && !empty($message)) {
  $displayMessage = $message;
  $messageType = 'info';
}
?>

<link rel="stylesheet" href="<?= BASEURL; ?>/css/update.css">
<div class="container">

<div class="container large">
  <h2>Update Data Pengguna Posyandu</h2>

  <?php if ($displayMessage): ?>
    <div class="alert alert-<?= htmlspecialchars($messageType); ?>">
      <?= htmlspecialchars($displayMessage); ?>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= BASEURL; ?>/user/update">
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama"
        value="<?= isset($data['user']['Nama']) ? htmlspecialchars($data['user']['Nama']) : ''; ?>" required>
    </div>

    <div class="form-group">
      <label>NIK</label>
      <input type="text" name="NIK"
        value="<?= isset($data['user']['NIK']) ? htmlspecialchars($data['user']['NIK']) : ''; ?>" readonly>
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <input type="text" name="alamat"
        value="<?= isset($data['user']['Alamat']) ? htmlspecialchars($data['user']['Alamat']) : ''; ?>" required>
    </div>

    <div class="form-group">
      <label>Jenis Kelamin</label>
      <div class="radio-group">
        <label>
          <input type="radio" name="gender" value="Perempuan" <?= (isset($data['user']['Jk']) && $data['user']['Jk'] === 'Perempuan') ? 'checked' : ''; ?>> Perempuan
        </label>
        <label>
          <input type="radio" name="gender" value="Laki-laki" <?= (isset($data['user']['Jk']) && $data['user']['Jk'] === 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki
        </label>
      </div>
    </div>

    <div class="form-group">
      <label>Umur</label>
      <input type="number" name="umur"
        value="<?= isset($data['user']['Umur']) ? htmlspecialchars($data['user']['Umur']) : ''; ?>" required>
    </div>

    <div class="form-group">
      <label>Password Baru (opsional)</label>
      <input type="password" name="password">
    </div>

    <div class="form-group">
      <button type="submit">Selesai</button>
    </div>
  </div>
  </form>
</div>
