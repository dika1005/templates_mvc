<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman <?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/login.css">
    <style>
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-weight: bold;
        }

        .message.success {
            background-color: #d4edda;
            /* Light green background */
            color: #155724;
            /* Dark green text */
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            /* Light red background */
            color: #721c24;
            /* Dark red text */
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <div class="container-wrapper">
        <div class="image-container">
        </div>
        <div class="login-container">
            <h2>Login</h2>

            <?php
            // Check if a message exists in the data array
            if (!empty($data['message'])) {
                // Apply a class based on the message type for styling
                $messageClass = 'message';
                if (!empty($data['message_type'])) {
                    $messageClass .= ' ' . $data['message_type']; // e.g., 'message success' or 'message error'
                }
                echo '<div class="' . $messageClass . '">' . $data['message'] . '</div>';
            }
            ?>

            <form action="backLog/doLogin.php" method="POST">
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