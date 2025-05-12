<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $data['judul'] ?? 'Admin Data Management'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/admin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Style sederhana untuk pesan feedback */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* Hapus style .action-links a jika sudah tidak ada tabel daftar */
        /*
        .action-links a {
             margin-right: 10px;
             text-decoration: none;
        }
         .action-links a i {
             vertical-align: middle;
         }
         */
        /* Pastikan elemen loader tersembunyi di awal */
        .loader {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        .debug-output {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    // ... kode navbar jika di-load terpisah ...
    ?>
    <div class="container">
        <header class="admin-header">
            <div class="logo">
                <i class="material-icons">admin_panel_settings</i>
                <h1>Admin Panel</h1>
            </div>
            <div class="header-actions">
                <span class="current-date" id="currentDate"></span>
            </div>
        </header>

        <div id="messageContainer" class="message-container">
            <?php
            // --- KODE PHP UNTUK MENAMPILKAN PESAN DARI SESSION (SAMA SEPERTI SEBELUMNYA) ---
            // Pastikan session dimulai jika belum (jika belum dilakukan di file utama seperti init.php)
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Cek apakah ada pesan feedback di session
            if (isset($_SESSION['pesan'])) {
                $pesan = $_SESSION['pesan']; // Ambil array pesan
                unset($_SESSION['pesan']); // HAPUS PESAN DARI SESSION agar hanya tampil sekali

                // Tampilkan pesan
                $alert_class = ($pesan['tipe'] == 'success') ? 'alert-success' : 'alert-danger';
                echo '<div class="alert ' . $alert_class . '" role="alert">';
                echo htmlspecialchars($pesan['isi']); // Gunakan htmlspecialchars untuk keamanan
                echo '</div>';
            }
            // -----------------------------------------------------------------------------
            ?>
        </div>

        <h2><i class="material-icons">add_circle_outline</i> Input Data Baru</h2>

        <form id="userForm" class="user-details" action="<?= BASEURL; ?>/admin/tambah" method="POST">
            <div class="input-box">
                <span class="details"><i class="material-icons">badge</i> NIK</span>
                <input type="text"
                    id="nik"
                    name="nik" pattern="[0-9]{16}"
                    maxlength="16"
                    placeholder="Masukkan NIK (16 digit)"
                    required>
                <span class="error-message" data-for="nik"></span>
            </div>
            <div class="input-box">
                <span class="details"><i class="material-icons">person</i> Nama Lengkap</span>
                <input type="text"
                    id="nama"
                    name="nama" maxlength="100"
                    placeholder="Masukkan nama lengkap"
                    required>
                <span class="error-message" data-for="nama"></span>
            </div>
            <div class="input-box">
                <span class="details"><i class="material-icons">cake</i> Umur</span>
                <input type="number"
                    id="umur"
                    name="umur" min="1"
                    max="120"
                    placeholder="Masukkan umur">
                <span class="error-message" data-for="umur"></span>
            </div>
            <div class="input-box">
                <span class="details"><i class="material-icons">straighten</i> Tinggi Badan (cm)</span>
                <input type="number"
                    id="tinggi"
                    name="tinggi_badan" min="1"
                    max="300"
                    placeholder="Masukkan tinggi badan"
                    step="0.01">
                <span class="error-message" data-for="tinggi"></span>
            </div>
            <div class="input-box">
                <span class="details"><i class="material-icons">monitor_weight</i> Berat Badan (kg)</span>
                <input type="number"
                    id="berat"
                    name="berat_badan" min="1"
                    max="500"
                    placeholder="Masukkan berat badan"
                    step="0.01">
                <span class="error-message" data-for="berat"></span>
            </div>
            <div class="input-box">
                <span class="details"><i class="material-icons">wc</i> Jenis Kelamin</span>
                <select id="jenisKelamin" name="jk" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <span class="error-message" data-for="jenisKelamin"></span>
            </div>
            <div class="input-box">
                <span class="details"><i class="material-icons">home</i> Alamat</span>
                <input type="text"
                    id="alamat"
                    name="alamat" placeholder="Masukkan alamat lengkap">
                <span class="error-message" data-for="alamat"></span>
            </div>
            <div class="button-container">
                <button type="submit" class="submit-button">
                    <i class="material-icons">save</i> Simpan Data
                </button>
            </div>
        </form>


        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner"></div>
        </div>

        <?php
        // --- HAPUS SELURUH BLOK KODE INI ---
        /*
            <div class="table-section card">
                <h2><i class="material-icons">list_alt</i> Daftar Data</h2>
                <div class="table-container">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                // ... header ...
                            </tr>
                        </thead>
                        <tbody>
                            // ... PHP loop data ...
                        </tbody>
                    </table>
                </div>
            </div>
            */
        // ------------------------------------
        ?>
    </div>

    <script>
        // Add current date to header
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Script untuk menampilkan spinner saat form disubmit
        document.getElementById('userForm').onsubmit = function() {
            document.getElementById('loadingSpinner').style.display = 'block';
        }
        // Script untuk menyembunyikan spinner setelah halaman dimuat ulang
        window.onload = function() {
            document.getElementById('loadingSpinner').style.display = 'none';
        }
    </script>
</body>

</html>