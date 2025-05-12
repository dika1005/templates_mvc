<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?? 'Pencarian Data'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/search_delete.css">
    <style>
        /* Pastikan elemen loader tersembunyi di awal */
        .loader {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        /* Style CSS Anda yang lain dari search_delete.css akan diterapkan */
        /* Jika ada style .debug-output, pastikan display: none */
        .debug-output {
            display: none;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
    <div class="container">

        <?php
        // --- KODE DEBUGGING DI VIEW SUDAH DIHAPUS ATAU DIKOMENTARI ---
        ?>

        <h2>Pencarian Data Pribadi</h2>
        <form action="<?= BASEURL; ?>/admin/search" method="POST" id="searchForm">
            <label for="nik">Masukkan NIK:</label>
            <input type="text" id="nik" name="nik" required placeholder="Masukkan NIK anda...">
            <input type="submit" value="Cari">
        </form>

        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
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
                <?php if (isset($data['hasil'])): // Jika data hasil ada di array $data 
                ?>
                    <?php $hasil = $data['hasil']; // Buat alias lokal untuk kemudahan 
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($hasil['NIK'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($hasil['Nama'] ?? '-') ?></td>
                        <td><?= htmlspecialchars(($hasil['Umur'] ?? '-') . ' tahun') ?></td>
                        <td><?= htmlspecialchars($hasil['Jk'] ?? '-') ?></td>
                        <td><?= htmlspecialchars(($hasil['tinggi_badan'] ?? '-') . ' cm') ?></td>
                        <td><?= htmlspecialchars(($hasil['berat_badan'] ?? '-') . ' kg') ?></td>
                        <td><?= htmlspecialchars($hasil['Alamat'] ?? '-') ?></td>
                    </tr>
                <?php endif; // Jika data hasil tidak ada, tbody akan kosong 
                ?>
            </tbody>
        </table>

        <?php if (isset($data['error'])): // Jika pesan error ada di array $data 
        ?>
            <p style="color:red; margin-top: 15px;"><?= htmlspecialchars($data['error'] ?? '-') ?></p>
        <?php endif; ?>

    </div>
        </div>
    <script>


        document.getElementById('searchForm').onsubmit = function() {
            // Show loader when form is submitted
            document.querySelector('.loader').style.display = 'block';
            document.getElementById('hasilPencarian').style.display = 'none';
            if (document.querySelector('p[style*="color:red"]')) {
                document.querySelector('p[style*="color:red"]').style.display = 'none';
            }
        }
    </script>
</body>

</html>