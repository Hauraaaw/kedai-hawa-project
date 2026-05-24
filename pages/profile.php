<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';
/** @var mysqli $conn */

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Kedai Hawa</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="page-container">

    <!-- HEADER -->
    <div class="header-page">

        <a href="beranda.php" class="btn-back">
            ←
        </a>

        <h2 class="page-title">PROFILE</h2>

        <div></div>

    </div>

    <!-- CONTENT -->
    <div style="padding: 30px; color:white;">

        <div class="login-container">

            <h2 class="login-title">
                Akun Saya
            </h2>

            <br>

            <p>
                <strong>Email:</strong><br>
                <?php echo $user['email']; ?>
            </p>

            <br><br>

            <a href="logout.php" class="btn-login" style="display:block; text-align:center; text-decoration:none;">
                LOGOUT
            </a>

        </div>

    </div>

    <!-- NAVBAR -->
    <?php include '../includes/navbar.php'; ?>

</div>

</body>
</html>