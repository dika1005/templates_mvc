<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Data Interaktif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-6">

    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">📋 Data yang Sudah Ada</h1>
        <table class="min-w-full divide-y divide-blue-300">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-blue-200">
                <tr>
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2">Budi Santoso</td>
                    <td class="px-4 py-2">2025-05-01</td>
                    <td class="px-4 py-2">
                        <button onclick="showModal('Budi Santoso', '2025-05-01', 'Jl. Mawar No. 12', 'Laki-laki', '25', '3374052505980001', '170', '65')" class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded">Lihat</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">2</td>
                    <td class="px-4 py-2">Siti Aminah</td>
                    <td class="px-4 py-2">2025-05-02</td>
                    <td class="px-4 py-2">
                        <button onclick="showModal('Siti Aminah', '2025-05-02', 'Desa Sidaraja RT 08 RW 02', 'Perempuan', '22', '3374052505980002', '165', '55')" class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded">Lihat</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-bold text-blue-700 mb-4">📌 Detail Data</h2>
            <p><strong>Nama:</strong> <span id="modal-nama"></span></p>
            <p><strong>Tanggal:</strong> <span id="modal-tanggal"></span></p>
            <p><strong>Alamat:</strong> <span id="modal-alamat"></span></p>
            <p><strong>Jenis Kelamin:</strong> <span id="modal-jk"></span></p>
            <p><strong>Umur:</strong> <span id="modal-umur"></span> tahun</p>
            <p><strong>NIK:</strong> <span id="modal-nik"></span></p>
            <p><strong>Tinggi Badan:</strong> <span id="modal-tinggi"></span> cm</p>
            <p><strong>Berat Badan:</strong> <span id="modal-berat"></span> kg</p>
            <div class="text-right mt-4">
                <button onclick="hideModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tutup</button>
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
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
        }

        function hideModal() {
            document.getElementById('modal').classList.remove('flex');
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

</body>
</html>
