<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data</title>
<link rel="stylesheet" href="<?= BASEURL; ?>/css/search_delete.css">
</head>
<body>
    <div class="container">
        <h2>Hapus Data Berdasarkan NIK</h2>
        <form action="phpDelete.php" method="POST">
            <label for="nik_delete">NIK:</label>
            <input type="text" id="nik_delete" name="nik" required placeholder="Masukkan NIK yang ingin dihapus">
            <input type="submit" value="Hapus Data" style="background: crimson;">
        </form>
    </div>
</body>
</html>
