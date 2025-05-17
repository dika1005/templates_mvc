<link rel="stylesheet" href="<?= BASEURL; ?>/css/dokumentasi.css">
<script src="<?= BASEURL; ?>/js/dokumentasi.js"></script>

<body>

    <h2>Galeri Dokumentasi</h2>

    <div class="galeri-container">
        <?php if (!empty($dokumentasi) && (is_array($dokumentasi) || is_object($dokumentasi))): ?>
            <?php foreach ($dokumentasi as $data): ?>
                <div class="galeri-item">
                    <img src="data:image/jpeg;base64, <?= base64_encode($data['src']); ?>" alt="<?= $data['caption']; ?>" onclick="openModal('data:image/jpeg;base64, <?= base64_encode($data['src']); ?>')">
                    <p><?= $data['caption']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Belum ada dokumentasi yang tersedia.</p>
        <?php endif; ?>
    </div>


    <div id="imageModal" class="modal" onclick="closeModal(event)">
        <div class="modal-header-actions">
            <a id="downloadImage" href="#" download class="modal-icon-btn" title="Download Image">
                &#x2913;
            </a>
            <button id="copyLink" class="modal-icon-btn" title="Copy Image URL">
                &#x2398;
            </button>
            <span class="close modal-icon-btn" onclick="closeModal(event)" title="Close">&times;</span>
        </div>
        <img class="modal-content" id="modalImage" onclick="event.stopPropagation()">
    </div>

</body>