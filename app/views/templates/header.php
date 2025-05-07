<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman <?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="<?= BASEURL; ?>/img/logo.svg" alt="Logo Posyandu">
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="#hero">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#blog">Artikel</a></li>
                <li><a href="#">Contact</a></li>
                <li><a target="_self" href="<?= BASEURL; ?>/register/index">Login</a></li>
            </ul>
        </nav>
    </header>