<?php
// Dummy data dokumentasi (anggap ini hasil dari database)
// Data ini mempertahankan urutan item
$dokumentasi = [
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'], // Landscape 1

];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Galeri Dokumentasi</title>
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
            /* Menggunakan Grid untuk tata letak dengan urutan asli */
            display: grid;
            /* Kolom responsif: minimal 250px, maksimal 1fr (mengisi ruang tersedia) */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            /* Jarak antar item grid (kolom dan baris) */
            gap: 6px;
            padding: 10px;
            /* Pusatkan item dalam kolom */
            justify-items: center;
            /* Penting: Sejajarkan item di bagian atas cell grid mereka */
            /* Ini mencegah item yang lebih pendek meregang, membuat gap terlihat di dalam cell */
            align-items: start;
            margin: auto;
            max-width: 1200px;
        }

        .galeri-item {
            text-align: center;
            /* Item akan mengisi ruang grid cell secara otomatis */
        }

        .galeri-item img {
            display: block;
            max-width: 100%;
            height: auto;
            /* Penting: Biarkan tinggi gambar menyesuaikan rasio aspek */
            object-fit: cover;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease;
        }

        /* Kelas portrait/landscape (untuk styling lain jika perlu) */
        .galeri-item img.portrait {
            /* Tidak perlu set dimensi di sini jika height: auto sudah digunakan */
        }

        .galeri-item img.landscape {
            /* Tidak perlu set dimensi di sini */
        }

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.galeri-item img');

            // --- Bagian untuk Mendeteksi Orientasi Gambar (Opsional) ---
            // Berguna jika Anda ingin menargetkan gambar portrait/landscape dengan CSS tambahan.
            images.forEach(img => {
                if (img.complete) {
                    checkOrientationAndAddClass(img);
                } else {
                    img.addEventListener('load', () => checkOrientationAndAddClass(img));
                }
                img.addEventListener('error', () => {
                    console.error('Gagal memuat gambar:', img.src);
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

        });

        // --- Fungsi Modal ---
        function openModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeModal(event) {
            if (event && event.target && event.target.id === 'modalImage') {
                return;
            }
            if (event && event.target && event.target.classList.contains('close')) {
                // Lanjutkan
            } else if (event && event.target !== document.getElementById('imageModal')) {
                return;
            }

            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modal.style.display = 'none';
            modalImage.src = '';
            document.body.classList.remove('modal-open');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });

        const style = document.createElement('style');
        style.innerHTML = `
            .modal-open {
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    </script>

</body>

</html>