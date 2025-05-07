<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Data Management</title>
    <link rel="stylesheet" href="admin-style.css">
    <!-- Add Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
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

        <div id="messageContainer" class="message-container"></div>
        
    <form id="userForm" class="user-details">
        <div class="input-box">
        <span class="details"><i class="material-icons">badge</i> NIK</span>
        <input type="text" 
                     id="nik" 
                     name="nik" 
                     pattern="[0-9]{16}" 
                     maxlength="16"
                     placeholder="Masukkan NIK (16 digit)" 
                     required>
        <span class="error-message" data-for="nik"></span>
    </div>
    <div class="input-box">
        <span class="details"><i class="material-icons">person</i> Nama Lengkap</span>
        <input type="text" 
                     id="nama" 
                     name="nama" 
                     maxlength="100"
                     placeholder="Masukkan nama lengkap" 
                     required>
        <span class="error-message" data-for="nama"></span>
    </div>
    <div class="input-box">
        <span class="details"><i class="material-icons">cake</i> Umur</span>
        <input type="number" 
                     id="umur" 
                     name="umur"
                     min="1" 
                     max="120"
                     placeholder="Masukkan umur" 
                     required>
        <span class="error-message" data-for="umur"></span>
    </div>
    <div class="input-box">
        <span class="details"><i class="material-icons">straighten</i> Tinggi Badan (cm)</span>
        <input type="number" 
                     id="tinggi" 
                     name="tinggi"
                     min="1" 
                     max="300"
                     placeholder="Masukkan tinggi badan" 
                     required>
        <span class="error-message" data-for="tinggi"></span>
    </div>
    <div class="input-box">
        <span class="details"><i class="material-icons">monitor_weight</i> Berat Badan (kg)</span>
        <input type="number" 
                     id="berat" 
                     name="berat"
                     min="1" 
                     max="500"
                     placeholder="Masukkan berat badan" 
                     required>
        <span class="error-message" data-for="berat"></span>
    </div>
    <div class="input-box">
        <span class="details"><i class="material-icons">wc</i> Jenis Kelamin</span>
        <select id="jenisKelamin" name="jenisKelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <span class="error-message" data-for="jenisKelamin"></span>
    </div>
    <div class="input-box">
        <span class="details"><i class="material-icons">home</i> Alamat</span>
        <input type="text" 
                     id="alamat" 
                     name="alamat"
                     placeholder="Masukkan alamat lengkap" 
                     required>
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

        <div class="table-section card">
            <h2><i class="material-icons">list_alt</i> Daftar Data</h2>
            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th><i class="material-icons">badge</i> NIK</th>
                            <th><i class="material-icons">person</i> Nama</th>
                            <th><i class="material-icons">cake</i> Umur</th>
                            <th><i class="material-icons">straighten</i> Tinggi Badan</th>
                            <th><i class="material-icons">monitor_weight</i> Berat Badan</th>
                            <th><i class="material-icons">wc</i> Jenis Kelamin</th>
                            <th><i class="material-icons">home</i> Alamat</th>
                            <th><i class="material-icons">settings</i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan muncul di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="admin.js"></script>
    <script>
        // Add current date to header
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    </script>
</body>
</html>