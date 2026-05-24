<?php
session_start();
require_once '../config/database.php';
/** @var mysqli $conn */

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Cek apakah email sudah terdaftar
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $error = 'Email sudah terdaftar!';
    } else {
        $query = "INSERT INTO users (email, password, created_at) VALUES ('$email', '$password', NOW())";
        if (mysqli_query($conn, $query)) {
            $success = 'Registrasi berhasil! Silakan login.';
        } else {
            $error = 'Registrasi gagal. Silakan coba lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kedai Hawa</title>
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
                <h2 class="login-title">REGISTER</h2>
                <p class="login-subtitle">Buat akun baru!</p>
                
                <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                <div class="success-message"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="" class="login-form" data-testid="register-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required data-testid="register-email-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required data-testid="register-password-input">
                    </div>
                    
                    <button type="submit" class="btn-login" data-testid="register-button">REGISTER</button>
                </form>
                
                <p class="register-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>