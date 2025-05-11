<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>

<body>
    <div class="container">
        <h2>Data Diri Anda</h2>

        <?php if (isset($data['user'])): ?>
            <table>
                <tr>
                    <th>NIK</th>
                    <td><?= htmlspecialchars($data['user']['NIK']); ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?= htmlspecialchars($data['user']['Nama']); ?></td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td><?= htmlspecialchars($data['user']['Umur']); ?> tahun</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= htmlspecialchars($data['user']['Alamat']); ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?= htmlspecialchars($data['user']['Jk']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>

        <br>
        <a href="<?= BASEURL; ?>/auth/logout">Logout</a>
    </div>
</body>

</html>