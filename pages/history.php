<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';
/** @var mysqli $conn */

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders 
          WHERE user_id = $user_id
          ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Kedai Hawa</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="page-container order-details-page">

    <!-- HEADER -->
    <div class="header-page">

        <a href="beranda.php" class="btn-back">
            ←
        </a>

        <h2 class="page-title">ORDER HISTORY</h2>

        <div></div>

    </div>

    <!-- CONTENT -->
    <div class="order-content">

        <?php if(mysqli_num_rows($result) > 0): ?>

            <?php while($order = mysqli_fetch_assoc($result)): ?>

                <div class="order-card">

                    <h3 class="order-item-name">
                        Order #<?php echo $order['id']; ?>
                    </h3>

                    <p class="order-item-desc">
                        Status:
                        <?php echo ucfirst($order['status']); ?>
                    </p>

                    <p class="order-item-price">
                        Rp.
                        <?php echo number_format($order['total_price'], 0, ',', '.'); ?>
                    </p>

                    <p class="order-item-desc">
                        <?php echo $order['created_at']; ?>
                    </p>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="order-card">

                <p>Belum ada riwayat pesanan 😭</p>

            </div>

        <?php endif; ?>

    </div>

    <!-- NAVBAR -->
    <?php include '../includes/navbar.php'; ?>

</div>

</body>
</html>