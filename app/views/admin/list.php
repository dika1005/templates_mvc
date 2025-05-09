<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Data Interaktif</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/admin.css" />
</head>
<body>

    <div class="container">
        <h1>📋 Data yang Sudah Ada</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Budi Santoso</td>
                    <td>2025-05-01</td>
                    <td>
                        <button onclick="showModal('Budi Santoso', '2025-05-01', 'Jl. Mawar No. 12', 'Laki-laki', '25', '3374052505980001', '170', '65')">Lihat</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Siti Aminah</td>
                    <td>2025-05-02</td>
                    <td>
                        <button onclick="showModal('Siti Aminah', '2025-05-02', 'Desa Sidaraja RT 08 RW 02', 'Perempuan', '22', '3374052505980002', '165', '55')">Lihat</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="modal">
        <div class="modal-content">
            <h2>📌 Detail Data</h2>
            <p><strong>Nama:</strong> <span id="modal-nama"></span></p>
            <p><strong>Tanggal:</strong> <span id="modal-tanggal"></span></p>
            <p><strong>Alamat:</strong> <span id="modal-alamat"></span></p>
            <p><strong>Jenis Kelamin:</strong> <span id="modal-jk"></span></p>
            <p><strong>Umur:</strong> <span id="modal-umur"></span> tahun</p>
            <p><strong>NIK:</strong> <span id="modal-nik"></span></p>
            <p><strong>Tinggi Badan:</strong> <span id="modal-tinggi"></span> cm</p>
            <p><strong>Berat Badan:</strong> <span id="modal-berat"></span> kg</p>
            <div class="close-btn">
                <button onclick="hideModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function showModal(nama, tanggal, alamat, jk, umur, nik, tinggi, berat) {
            document.getElementById('modal-nama').textContent = nama;
            document.getElementById('modal-tanggal').textContent = tanggal;
            document.getElementById('modal-alamat').textContent = alamat;
            document.getElementById('modal-jk').textContent = jk;
            document.getElementById('modal-umur').textContent = umur;
            document.getElementById('modal-nik').textContent = nik;
            document.getElementById('modal-tinggi').textContent = tinggi;
            document.getElementById('modal-berat').textContent = berat;
            document.getElementById('modal').classList.add('active');
        }

        function hideModal() {
            document.getElementById('modal').classList.remove('active');
        }
    </script>

</body>
</html>
