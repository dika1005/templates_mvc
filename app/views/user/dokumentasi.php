<?php
// Dummy data dokumentasi (tidak diubah)
$dokumentasi = [
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
    ['judul' => 'Posyandu A', 'url_gambar' => 'https://asset.kompas.com/crops/N0nrBGPpec71m_L7ARAIy23ge3E=/0x0:0x0/750x500/data/photo/buku/64910f4eb91eb.png'],
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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 10px;
            justify-items: center;
            align-items: start;
            margin: auto;
            max-width: 1200px;
            /* clear: both; /* Tambahkan jika ada float di atasnya */
        }

        .galeri-item {
            text-align: center;
        }

        .galeri-item img {
            display: block;
            max-width: 100%;
            height: auto;
            object-fit: cover;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease;
        }

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

        /* === Gaya untuk Tombol Close dan Tombol Aksi Header === */
        /* Container untuk tombol close dan aksi lainnya di header modal */
        .modal-header-actions {
            position: absolute;
            top: 20px;
            /* Sesuaikan posisi dari atas */
            right: 30px;
            /* Sesuaikan posisi dari kanan */
            z-index: 100;
            /* Pastikan di atas konten */
            pointer-events: none;
            /* Default: biarkan event klik tembus (untuk klik di luar tombol) */
            display: flex;
            /* Atur item dalam baris */
            gap: 50px;
            /* Jarak antar tombol */
            align-items: center;
            /* Pusatkan item secara vertikal */
        }


        /* Gaya dasar untuk semua tombol ikon di header (Close, Download, Copy) */
        .modal-icon-btn {
            display: block;
            /* Untuk flexbox, pastikan block */
            color: #fff;
            /* Warna putih */
            font-size: 28px;
            /* Ukuran ikon/font, sesuaikan */
            font-weight: bold;
            /* Tebal */
            cursor: pointer;
            pointer-events: auto;
            /* Aktifkan kembali event pointer untuk elemen ini */
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            /* Bayangan teks/ikon */
            text-decoration: none;
            /* Hapus garis bawah link */
            background: none;
            /* Hapus background */
            border: none;
            /* Hapus border */
            padding: 0;
            /* Hapus padding */
            margin: 0;
            /* Hapus margin */
            line-height: 1;
            /* Atur line height */
            transition: color 0.3s ease;
            /* Transisi saat hover */
        }

        /* Gaya khusus untuk tombol Close */
        .close.modal-icon-btn {
            font-size: 40px;
            /* Biarkan ukuran X lebih besar */
            line-height: 1;
            padding-top: 2px;
            /* Penyesuaian vertikal jika diperlukan */
        }


        .modal-icon-btn:hover {
            color: red;
            /* Efek hover */
        }

        /* ===================================================== */

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
        <div class="modal-header-actions">
            <a id="downloadImage" href="#" download class="modal-icon-btn" title="Download Image">
                &#x2913; </a>
            <button id="copyLink" class="modal-icon-btn" title="Copy Image URL">
                &#x2398; </button>
            <span class="close modal-icon-btn" onclick="closeModal(event)" title="Close">&times;</span>
        </div>
        <img class="modal-content" id="modalImage" onclick="event.stopPropagation()">

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.galeri-item img');
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

            // === Script untuk Fitur Download dan Bagikan ===
            const copyLinkButton = document.getElementById('copyLink');
            if (copyLinkButton) {
                copyLinkButton.addEventListener('click', function() {
                    const imageUrl = document.getElementById('modalImage').src; // Ambil URL dari gambar modal
                    if (imageUrl) {
                        navigator.clipboard.writeText(imageUrl).then(function() {
                            const originalTitle = copyLinkButton.getAttribute('title');
                            copyLinkButton.textContent = 'Copied!'; // Feedback teks di tombol
                            copyLinkButton.removeAttribute('title'); // Hapus title sementara
                            setTimeout(() => {
                                // Kembalikan teks dan title setelah beberapa saat
                                // Anda mungkin perlu menyimpan ikon unicode jika menggunakannya
                                copyLinkButton.innerHTML = '&#x2398;'; // Ganti kembali jika pakai ikon
                                copyLinkButton.setAttribute('title', originalTitle);
                            }, 2000);
                        }).catch(function(err) {
                            console.error('Failed to copy image URL: ', err);
                            const originalTitle = copyLinkButton.getAttribute('title');
                            copyLinkButton.textContent = 'Failed!'; // Feedback error
                            copyLinkButton.removeAttribute('title');
                            setTimeout(() => {
                                copyLinkButton.innerHTML = '&#x2398;'; // Ganti kembali jika pakai ikon
                                copyLinkButton.setAttribute('title', originalTitle);
                            }, 2000);
                        });
                    }
                });
            }
            // ==============================================

        });

        // --- Fungsi Modal (Diperbarui) ---
        function openModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const downloadLink = modal.querySelector('#downloadImage'); // Ambil link di dalam modal

            modalImage.src = src;

            if (downloadLink) {
                downloadLink.href = src;
                downloadLink.setAttribute('download', '');
            }

            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeModal(event) {
            if (event && event.target && event.target.id === 'modalImage') {
                return;
            }
            // Cek apakah target adalah bagian dari modal-header-actions tapi BUKAN tombolnya sendiri
            if (event && event.target && event.target.classList.contains('modal-header-actions')) {
                // Jika klik di area container aksi tapi tidak di tombolnya, jangan tutup modal
                return;
            }
            // Jika target adalah tombol close atau klik di background modal (kecuali gambar modal)
            if (event && event.target && (event.target.classList.contains('close') || event.target.classList.contains('modal'))) {
                // Lanjutkan menutup
            } else {
                // Jika klik di tempat lain yang tidak spesifik, jangan tutup
                return;
            }


            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modal.style.display = 'none';
            modalImage.src = ''; // Kosongkan src untuk menghemat memori
            if (document.getElementById('downloadImage')) {
                document.getElementById('downloadImage').href = '#';
                document.getElementById('downloadImage').removeAttribute('download'); // Hapus atribut download
            }
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