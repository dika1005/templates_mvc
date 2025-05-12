<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/search_delete.css">
</head>
<body>
    <div class="form-wrapper">
    <div class="container">
        <h2>Hapus Data Berdasarkan NIK</h2>

        <?php if (isset($_GET['success'])): ?>
            <p style="color:green;">Data berhasil dihapus!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p style="color:red;">Gagal menghapus data. Mungkin NIK tidak ditemukan?</p>
        <?php endif; ?>

        <form action="<?= BASEURL; ?>/admin/deleteByNik" method="POST">
            <label for="nik_delete">NIK:</label>
            <input type="text" id="nik_delete" name="nik" required placeholder="Masukkan NIK yang ingin dihapus">
            <input type="submit" value="Hapus Data" style="background: crimson;">
        </form>
    </div>
    </div>
</body>
</html>
