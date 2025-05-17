<link rel="stylesheet" href="<?= BASEURL; ?>/css/dokumentasi.css">
<script src="<?= BASEURL; ?>/js/dokumentasi.js"></script>

<body>

    <h2>Galeri Dokumentasi</h2>

    <div class="galeri-container">
        <?php if (!empty($dokumentasi)): ?>
            <?php foreach ($dokumentasi as $data): ?>
                <div class="galeri-item">
                    <img
                        src="data:<?= $data['tipe_gambar']; ?>;base64,<?= base64_encode($data['gambar']); ?>"
                        alt="<?= htmlspecialchars($data['judul']); ?>"
                        onclick="openModal(this.src)">
                    <p><?= htmlspecialchars($data['judul']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Belum ada dokumentasi yang tersedia.</p>
        <?php endif; ?>
    </div>




    <div id="imageModal" class="modal" onclick="closeModal(event)">
        <div class="modal-header-actions">
            <a id="downloadImage" href="#" download class="modal-icon-btn" title="Download Image">&#x2913;</a>
            <button id="copyLink" class="modal-icon-btn" title="Copy Image URL">&#x2398;</button>
            <span class="close modal-icon-btn" onclick="closeModal(event)" title="Close">&times;</span>
        </div>

        <div class="modal-content-wrapper" onclick="event.stopPropagation()">
            <img id="modalImage" class="modal-content" src="" alt="Preview Image">

            <div id="modalThumbnails" class="modal-thumbnails">
                <!-- Thumbnail images akan muncul di sini -->
            </div>
        </div>
        <div class="modal-navigation">
            <button id="prevBtn">&#10094;</button>
            <button id="nextBtn">&#10095;</button>
        </div>
    </div>

    <img class="modal-content" id="modalImage" onclick="event.stopPropagation()">
    </div>

</body>