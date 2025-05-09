<?php
session_start();
if (isset($_SESSION['pesan'])) {
    echo '<p style="color: green; font-weight: bold;">' . $_SESSION['pesan'] . '</p>';
    unset($_SESSION['pesan']);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/login.css">

</head>

<body>
    <div class="container-wrapper">
        <div class="image-container">
            <!-- Gambar bisa ditambahkan di sini -->
        </div>
        <div class="login-container">
            <h2>Login</h2>
            <?php $loginMessage = $loginMessage ?? ''; ?>
            <?= $loginMessage ?>
            <form action="backLog/doLogin.php" method="POST">
                <input type="text" name="username" placeholder="Username" autocomplete="username" required>
                <input type="password" name="password" placeholder="Password" autocomplete="current-password" required>

                <select name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit">Login</button>
                <p>Belum punya akun? <a href="<?= BASEURL; ?>/auth/register">Daftar di sini</a></p>
            </form>
        </div>
    </div>
</body>

</html>