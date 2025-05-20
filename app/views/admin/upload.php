<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $data['judul'] ?? 'Upload Dokumentasi'; ?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/upload.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <h1>🎉 Upload Dokumentasi Posyandu 🎈</h1>
  <div class="upload-box">
    <p>Yuk upload foto-foto kegiatan Posyandu! 📸✨</p>
    <form method="POST" action="<?= BASEURL; ?>/admin/kirim" enctype="multipart/form-data">
      <input type="text" name="judul" placeholder="Masukkan Judul Dokumentasi" required />
      <input type="file" name="media" id="mediaUpload" accept="image/*,video/*" required />

      <div class="form-controls">
        <label for="mediaUpload" class="custom-file-upload">📁 Pilih File </label>
        <button type="submit">Upload Sekarang!</button>
      </div>

      <div class="preview" id="previewBox"></div>
    </form>
  </div>

  <script>
    const mediaInput = document.getElementById('mediaUpload');
    const previewBox = document.getElementById('previewBox');

    mediaInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const fileType = file.type;
          if (fileType.startsWith('image/')) {
            previewBox.innerHTML = `<img src="${e.target.result}" alt="Preview Gambar" />`;
          } else if (fileType.startsWith('video/')) {
            previewBox.innerHTML = `<video controls width="100%"><source src="${e.target.result}" type="${fileType}">Video tidak bisa diputar</video>`;
          } else {
            previewBox.innerHTML = `<p>File tidak bisa ditampilkan</p>`;
          }
        };
        reader.readAsDataURL(file);
      } else {
        previewBox.innerHTML = '';
      }
    });
  </script>

  <?php if (isset($data['berhasil'])) : ?>
  <script>
    Swal.fire({
      icon: '<?= $data['berhasil'] ? 'success' : 'error' ?>',
      title: '<?= $data['berhasil'] ? 'Upload Berhasil!' : 'Upload Gagal!' ?>',
      text: '<?= $data['berhasil'] ? 'Dokumentasi berhasil disimpan!' : 'Gagal menyimpan dokumentasi ke database.' ?>',
      confirmButtonText: 'Oke'
    });
  </script>
  <?php endif; ?>
</body>
</html>
