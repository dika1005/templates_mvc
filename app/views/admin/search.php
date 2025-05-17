<?php
// Jangan panggil session_start() di sini!
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Data Center Posyandu</title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/search_delete.css">
  <style>
    canvas#statsChart {
      width: 100%;
      max-width: 600px;
      height: auto;
      aspect-ratio: 3 / 1;
      margin: 0 auto;
      display: block;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>📋 Pusat Data Posyandu </h1>

    <!-- Form Search by NIK -->
    <form method="post" action="<?= BASEURL ?>/admin/search" class="input-group">
      <input type="text" name="nik" placeholder="Masukkan NIK..." required>
      <button class="btn-klee" type="submit">🔍 Cari</button>
    </form>

    <!-- Tampilkan error kalau ada -->
    <?php if (isset($data['error'])): ?>
      <p style="color: red;"><?= htmlspecialchars($data['error']) ?></p>
    <?php endif; ?>

    <!-- Tampilkan hasil pencarian -->
    <?php if (isset($data['hasil'])): ?>
      <div id="dataTable">
        <table border="1" cellpadding="8" cellspacing="0">
          <tr>
            <th>Nama</th>
            <th>NIK</th>
            <th>Umur</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
          </tr>
          <tr>
            <td><?= htmlspecialchars($data['hasil']['Nama']) ?></td>
            <td><?= htmlspecialchars($data['hasil']['NIK']) ?></td>
            <td><?= htmlspecialchars($data['hasil']['Umur']) ?></td>
            <td><?= htmlspecialchars($data['hasil']['Alamat']) ?></td>
            <td><?= htmlspecialchars($data['hasil']['Jk']) ?></td>
          </tr>
        </table>
      </div>
    <?php elseif (!isset($data['error'])): ?>
      <!-- Tampilkan ini kalau belum pernah search sama sekali -->
      <p>Data hasil pencarian gak ada nih.</p>
    <?php endif; ?>

    <!-- Statistik -->
    <div>
      <h3>📊 Statistik Berdasarkan Kelompok Umur</h3>
      <canvas id="statsChart"></canvas>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const statistikData = {
      Balita: <?= $data['balita'] ?? 0 ?>,
      "Ibu Hamil": <?= $data['ibuHamil'] ?? 0 ?>,
      Lansia: <?= $data['lansia'] ?? 0 ?>
    };

    const ctx = document.getElementById('statsChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Balita (0-5)', 'Ibu Hamil (23-40)', 'Lansia (50-70)'],
        datasets: [{
          label: 'Jumlah',
          data: [statistikData.Balita, statistikData["Ibu Hamil"], statistikData.Lansia],
          backgroundColor: ['#ff6b6b', '#ffcc6b', '#6bcfff']
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Kelompok Umur'
            }
          }
        }
      }
    });
  </script>
</body>

</html>