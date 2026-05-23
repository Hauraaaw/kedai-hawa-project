<?php
session_start();
require_once '../config/database.php';
/** @var mysqli $conn */

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header('Location: beranda.php');
            exit();
        } else {
            $error = 'Email atau password salah!';
        }
    } else {
        $error = 'Email atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kedai Hawa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="page-container login-page">
        <div class="content-wrapper">
            <div class="logo-container-small">
                <img src="https://static.prod-images.emergentagent.com/jobs/11af06eb-deab-4fc3-acd8-8d0834568e32/images/de13689065d4c127b9f04e22ad0d7358461d53761dc0676680ddaa3560a7d413.png" alt="Kedai Hawa Logo" class="login-logo">
            </div>

            <div class="brand-text">
                <h1 class="brand-title">KEDAI HAWA</h1>
                <p class="brand-tagline">Pedas nampol bikin nagih</p>
            </div>

            <div class="login-container">
                <h2 class="login-title">LOGIN</h2>
                <p class="login-subtitle">Yuk order sekarang!!</p>

                <?php if ($error): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="" class="login-form" data-testid="login-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required data-testid="email-input">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required data-testid="password-input">
                    </div>

                    <button type="submit" class="btn-login" data-testid="login-button">LOGIN</button>
                </form>

                <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>

