<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman <?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/login.css">
    <style>
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>

<body>
    <div class="container-wrapper">
        <div class="image-container">
        </div>
        <div class="login-container">
            <h2>Login Dulu Yuk</h2>

            <?php
            if (!empty($data['message'])) {
                $messageClass = 'message';
                if (!empty($data['message_type'])) {
                    $messageClass .= ' ' . $data['message_type'];
                }
                echo '<div class="' . $messageClass . '">' . $data['message'] . '</div>';
            }
            ?>

            <form action="<?= BASEURL; ?>/auth/prosesLogin" method="POST">
                <input type="text" name="username" placeholder="NIK or Username" autocomplete="username" required>
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