<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman <?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/home.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="<?= BASEURL; ?>/img/logo.svg" alt="Logo Posyandu">
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="#hero">Home</a></li>
                <li><a href="#tentang">About</a></li>
                <li><a href="#blog">Artikel</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a target="_self" href="<?= BASEURL; ?>/auth/login">Login</a></li>
            </ul>
        </nav>
    </header>