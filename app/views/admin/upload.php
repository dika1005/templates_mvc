<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["media"])) {
  $folder = "uploads/";
  $namaFile = basename($_FILES["media"]["name"]);
  $tujuan = $folder . $namaFile;

  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/webm', 'video/ogg'];
  $maxSize = 500 * 5024 * 5024; // 10MB

  $tipeFile = $_FILES["media"]["type"];
  $ukuranFile = $_FILES["media"]["size"];

  if (!in_array($tipeFile, $allowedTypes)) {
    echo "<script>alert('Jenis file tidak didukung 😢 Hanya gambar dan video ya!');</script>";
  } elseif ($ukuranFile > $maxSize) {
    echo "<script>alert('Ukurannya terlalu besar 😱 Maksimal 10MB ya!');</script>";
  } elseif (move_uploaded_file($_FILES["media"]["tmp_name"], $tujuan)) {
    header("Location: galeri.php");
    exit();
  } else {
    echo "<script>alert('Upload gagal 😭 Coba lagi ya!');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload Dokumentasi Posyandu</title>
      <title><?= $data['judul'] ?? 'Admin Dokumentasi'; ?></title>

      <link rel="stylesheet" href="<?= BASEURL; ?>/css/upload.css">

</head>
<body>
  <h1>🎉 Upload Dokumentasi Posyandu 🎈</h1>
  <div class="upload-box">
    <p>Yuk upload foto-foto lucu kegiatan Posyandu! 📸✨</p>
<form method="POST" enctype="multipart/form-data">
  <input type="text" name="judul" placeholder="Masukkan Judul Dokumentasi" required />
  <input type="file" name="media" id="mediaUpload" accept="image/*,video/*" required />

  <div class="form-controls">
    <label for="mediaUpload" class="custom-file-upload">📁 Pilih File Lucu</label>
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

</body>
</html>
