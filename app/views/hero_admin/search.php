<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data</title>
    <link rel="stylesheet" href="search_delete.css">
</head>
<body>
    <div class="container">
        <h2>Pencarian Data Pribadi</h2>
        <form action="phpSearch.php" method="POST" id="searchForm">
            <label for="nik">Masukkan NIK:</label>
            <input type="text" id="nik" name="nik" required placeholder="Masukkan NIK anda...">
            <input type="submit" value="Cari">
        </form>

        <div class="loader">
            <div></div><div></div><div></div>
        </div>

        <table id="hasilPencarian">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data akan muncul di sini -->
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchForm').onsubmit = function() {
            document.querySelector('.loader').style.display = 'block';
            document.getElementById('hasilPencarian').style.opacity = '0.5';
        }
    </script>
</body>
</html>
