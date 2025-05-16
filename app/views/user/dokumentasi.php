<!-- views/user/dokumentasi.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/dokumentasi.css"> <!-- CSS buatan sendiri -->
</head>

<body>

    <h1 style="text-align: center; margin-bottom: 20px;"><?= $data['judul']; ?></h1>

    <div class="gallery-container">
        <?php if (!empty($dokumentasi) && is_array($dokumentasi)): ?>
            <?php foreach ($dokumentasi as $index => $img): ?>
                <img src="<?= htmlspecialchars($img['src']) ?>"
                    alt="<?= htmlspecialchars($img['caption'] ?? '') ?>"
                    class="gallery-image"
                    onclick="openModal(<?= $index ?>)">
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada dokumentasi yang tersedia.</p>
        <?php endif; ?>

    </div>

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">×</span>
            <span class="nav-btn left" onclick="prevImage()">⟨</span>
            <img id="modalImage" src="" alt="Preview" class="modal-image">
            <span class="nav-btn right" onclick="nextImage()">⟩</span>
        </div>
    </div>

    <script>
        const images = <?= json_encode($data['dokumentasi']); ?>;
        let currentIndex = 0;

        function openModal(index) {
            currentIndex = index;
            document.getElementById('modalImage').src = '<?= BASEURL ?>/img/dokumentasi/' + images[index].gambar;
            document.getElementById('imageModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            openModal(currentIndex);
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            openModal(currentIndex);
        }
    </script>
</body>

</html>