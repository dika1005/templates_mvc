<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel</title>
<link rel="stylesheet" href="<?= BASEURL; ?>/css/navbar1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-logo">
        <img src="<?= BASEURL; ?>/img/logo.svg" alt="Logo Posyandu" class="logo-img">
      </div>
      <div class="nav-toggle" onclick="toggleMenu()">☰</div>
      <ul class="nav-links">
        <li><a href="admin.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="<?= BASEURL; ?>/admin/search"><i class="fas fa-search"></i> Search Data</a></li>
        <li><a href="<?= BASEURL; ?>/admin/input"><i class="fas fa-pen"></i> Input Data</a></li>
        <li><a href="<?= BASEURL; ?>/admin/list"><i class="fas fa-list"></i> List Data</a></li>
        <li><a href="<?= BASEURL; ?>/admin/upload"><i class="fas fa-upload"></i> Upload Data</a></li>
        
        <li><a href="<?= BASEURL; ?>/home/index"><i class="fas fa-sign-out"></i> Keluar </a></li>
      </ul>
    </div>
  </nav>