<link rel="stylesheet" href="<?= BASEURL; ?> /css/index.css">

<body>
    <main>
        <?php
        // Ambil data user ke variabel lokal untuk kemudahan akses
        $user = $data['user'] ?? null; // Gunakan null coalescing operator untuk keamanan
        ?>

        <h1>Selamat Datang, <?= $user ? htmlspecialchars($user['Nama']) : 'Pengguna!'; ?></h1>
        <p>Silakan pilih menu di navbar untuk mengakses fitur yang tersedia.</p>

        <?php
        // Kode untuk menangani pesan flash yang formatnya array ['tipe' => ..., 'isi' => ...]
        $message = $data['message'] ?? null; // Ambil pesan dari data
        $displayMessage = null; // Variabel untuk pesan string yang akan ditampilkan
        $messageType = 'info'; // Tipe default
        
        // Cek apakah pesan adalah array dan memiliki kunci 'isi'
        if (is_array($message) && isset($message['isi']) && !empty($message['isi'])) {
            $displayMessage = $message['isi']; // Ambil isi pesan
            $messageType = $message['tipe'] ?? 'info'; // Ambil tipe, default info
        }
        // Jika pesan format string lama (kasus lama atau kesalahan), bisa ditangani juga
        else if (is_string($message) && !empty($message)) {
            $displayMessage = $message; // Ambil pesan string
            $messageType = 'info'; // Default info
        }
        ?>

        <?php // Gunakan $displayMessage untuk mengecek apakah ada pesan string untuk ditampilkan ?>
        <?php if ($displayMessage): ?>
            <div class="alert alert-<?= htmlspecialchars($messageType); ?>">
                <?= htmlspecialchars($displayMessage); // Tampilkan pesan string dan sanitasi ?>
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