<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order - Kedai Hawa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="page-container confirm-page">
        <!-- Header -->
        <div class="header-page">
            <a href="beranda.php" class="btn-back" data-testid="back-to-menu-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="#FF1493" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <h2 class="page-title">CONFIRM ORDER</h2>
            <a href="order-details.php" class="btn-cart-icon" data-testid="cart-icon-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.25 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.28 15 7.17 14.89 7.17 14.75L7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L20.88 5.48C20.96 5.34 21 5.17 21 5C21 4.45 20.55 4 20 4H5.21L4.27 2H1ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z" fill="#FF1493"/>
                </svg>
            </a>
        </div>
        
        <!-- Content -->
        <div class="confirm-content">
            <div class="confirm-card">
                <div class="success-icon" data-testid="success-icon">
    <svg width="260" height="260" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="40" cy="40" r="38" fill="#FF1493"/>
        <path d="M25 40L35 50L55 30"
        stroke="white"
        stroke-width="7"
        stroke-linecap="round"
        stroke-linejoin="round"/>
    </svg>
</div>
                <h2 class="success-title" data-testid="success-message">ORDER SUCCESSFUL</h2>
            </div>
        </div>
        
        <!-- Bottom Navigation -->
        <?php include '../includes/navbar.php'; ?>
    </div>
    
    <script src="../assets/js/script.js"></script>
</body>
</html>