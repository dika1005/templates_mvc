<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel</title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-logo">
        <img src="<?= BASEURL; ?>/img/" alt="Logo Posyandu" class="logo-img">
      </div>
      <div class="nav-toggle" onclick="toggleMenu()">☰</div>
      <ul class="nav-links">
        <li><a href="<?= BASEURL; ?>/admin/search"><i class="fas fa-search"></i> Search Data</a></li>
        <li><a href="<?= BASEURL; ?>/admin/delete"><i class="fas fa-trash"></i> Delete Data</a></li>
        <li><a href="admin.php"><i class="fas fa-pen"></i> Input Data</a></li>
        <li><a href="list.php"><i class="fas fa-list"></i> List Data</a></li>
      </ul>
    </div>
  </nav>