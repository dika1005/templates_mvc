<link rel="stylesheet" href="<?= BASEURL; ?> /css/index.css">

<body>
    <main>
        <?php
        $user = $data['user'] ?? null;
        ?>

        <h1>Selamat Datang, <?= $user ? htmlspecialchars($user['Nama']) : 'Pengguna!'; ?></h1>
        <p>Silakan pilih menu di navbar untuk mengakses fitur yang tersedia.</p>

        <?php
        $message = $data['message'] ?? null;
        $displayMessage = null;
        $messageType = 'info';
        
        if (is_array($message) && isset($message['isi']) && !empty($message['isi'])) {
            $displayMessage = $message['isi'];
            $messageType = $message['tipe'] ?? 'info';
        }
        else if (is_string($message) && !empty($message)) {
            $displayMessage = $message;
            $messageType = 'info';
        }
        ?>

        <?php if ($displayMessage): ?>
            <div class="alert alert-<?= htmlspecialchars($messageType); ?>">
                <?= htmlspecialchars($displayMessage); ?>
            </div>
        <?php endif; ?>


        <div class="card">
            <table class="data-table">
                <?php if ($user): ?>
                    <tr>
                        <th>NIK</th>
                        <td><?= htmlspecialchars($user['NIK']); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?= htmlspecialchars($user['Nama']); ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= htmlspecialchars($user['Alamat']); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= htmlspecialchars($user['Jk']); ?></td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td><?= htmlspecialchars($user['Umur']); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="2" style="text-align: center;">Data pengguna tidak tersedia. Silakan login.</td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>

    </main>
</body>
