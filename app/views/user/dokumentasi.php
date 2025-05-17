<?php
// Dummy data dokumentasi (tidak diubah)
$dokumentasi = [
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://images-cdn.ubuy.co.id/6359be177f967966245ad033-peaky-blinders-poster-tommy-smoking.jpg'], // Portrait 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://images-cdn.ubuy.co.id/6359be177f967966245ad033-peaky-blinders-poster-tommy-smoking.jpg'], // Portrait 2
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 2
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy24ge3E=/0x0:0x0/750x1000/data/photo/buku/contoh-potrait.jpg'], // Portrait 3 (Contoh lebih tinggi)
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 3
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://images-cdn.ubuy.co.id/6359be177f967966245ad033-peaky-blinders-poster-tommy-smoking.jpg'], // Portrait 4
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 4
];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Galeri Dokumentasi Masonry</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .galeri-container {
            /* Hapus properti Grid */
            padding: 10px;
            position: relative;
            /* Penting untuk Masonry */
            margin: auto;
            max-width: 1200px;
            /* Batasi lebar maksimum */
            /* Ini adalah kontainer utama untuk Masonry. */
            /* Pastikan tidak ada float atau posisi absolut/fixed dari elemen INDUKNYA yang mengganggu lebarnya */
            /* border: 1px solid red; /* Garis bantu - aktifkan untuk lihat batasnya */
        }

        .galeri-item {
            /* Tentukan lebar item menggunakan persentase */
            width: calc(33.33% - 6px);
            /* Contoh 3 kolom, kurangi gutter */
            margin-bottom: 6px;
            /* Gap vertikal */
            float: left;
            /* Diperlukan oleh Masonry untuk perhitungan awal */
            text-align: center;
            box-sizing: border-box;
            /* Pastikan padding/border masuk hitungan width */
            /* border: 1px solid blue; /* Garis bantu */
        }

        /* Media Queries untuk Responsivitas Lebar Item */
        @media (max-width: 992px) {
            .galeri-item {
                width: calc(50% - 6px);
                /* 2 kolom */
            }
        }

        @media (max-width: 600px) {
            .galeri-item {
                width: calc(100% - 6px);
                /* 1 kolom */
            }
        }


        .galeri-item img {
            display: block;
            max-width: 100%;
            height: auto;
            /* Penting */
            object-fit: cover;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease;
        }

        /* Kelas portrait/landscape (opsional) */
        .galeri-item img.portrait {}

        .galeri-item img.landscape {}

        .galeri-item img:hover {
            transform: scale(1.03);
        }

        .galeri-item p {
            margin-top: 5px;
            word-break: break-word;
            font-size: 0.9em;
            color: #333;
        }

        /* Styling untuk Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            text-align: center;
            overflow: auto;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            max-width: 90%;
            max-height: 90vh;
            margin: auto;
            display: block;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            .modal-content {
                max-width: 95%;
                max-height: 85vh;
            }
        }

        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 100;
            pointer-events: auto;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .close:hover {
            color: red;
        }

        .modal-open {
            overflow: hidden;
        }
    </style>
</head>

<body>

    <h2>Galeri Dokumentasi</h2>

    <div class="galeri-container">
        <?php foreach ($dokumentasi as $data): ?>
            <div class="galeri-item">
                <img src="<?= $data['url_gambar']; ?>" alt="<?= $data['judul']; ?>"
                    onclick="openModal('<?= $data['url_gambar']; ?>')">
                <p><?= $data['judul']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="imageModal" class="modal" onclick="closeModal(event)">
        <span class="close" onclick="closeModal(event)">&times;</span>
        <img class="modal-content" id="modalImage" onclick="event.stopPropagation()">
    </div>

    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.galeri-item img');
            const grid = document.querySelector('.galeri-container');

            // --- Bagian Mendeteksi Orientasi (Opsional) ---
            images.forEach(img => {
                if (img.complete) {
                    checkOrientationAndAddClass(img);
                } else {
                    img.addEventListener('load', () => checkOrientationAndAddClass(img));
                }
                img.addEventListener('error', () => {
                    console.error('Gagal memuat gambar:', img.src);
                    if (masonry) {
                        masonry.layout();
                    } // Tata ulang jika item disembunyikan/gagal
                });
            });

            function checkOrientationAndAddClass(img) {
                const naturalWidth = img.naturalWidth;
                const naturalHeight = img.naturalHeight;
                if (naturalHeight > naturalWidth + 1) {
                    img.classList.add('portrait');
                } else {
                    img.classList.add('landscape');
                }
            }
            // --- Akhir Deteksi Orientasi ---

            // --- Inisialisasi Masonry ---
            let masonry;
            imagesLoaded(grid, function() {
                masonry = new Masonry(grid, {
                    itemSelector: '.galeri-item',
                    // Set columnWidth ke string persentase yang sesuai dengan lebar item
                    // Ini harus sesuai dengan lebar yang Anda tentukan di CSS untuk .galeri-item
                    columnWidth: '.galeri-item', // Menggunakan item pertama untuk menentukan lebar kolom.
                    // Atau bisa coba string persentase: '33.33%' jika item width kalkulasi lain
                    gutter: 6, // Jarak horizontal antar kolom (pixel)
                    percentPosition: true // Gunakan persentase untuk penempatan
                });
                console.log('Masonry initialized');
            });
            // --- Akhir Inisialisasi Masonry ---

        });

        // --- Fungsi Modal (Tetap sama) ---
        function openModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeModal(event) {
            if (event && event.target && event.target.id === 'modalImage') return;
            if (event && event.target && event.target.classList.contains('close')) {} else if (event && event.target !== document.getElementById('imageModal')) return;

            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modal.style.display = 'none';
            modalImage.src = '';
            document.body.classList.remove('modal-open');
        }
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") closeModal();
        });
        const style = document.createElement('style');
        style.innerHTML = `.modal-open { overflow: hidden; }`;
        document.head.appendChild(style);
    </script>

</body>

</html>