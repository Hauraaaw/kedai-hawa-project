<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';

/** @var mysqli $conn */

// Ambil produk dari database
$query = "SELECT * FROM products ORDER BY id ASC";
$result = mysqli_query($conn, $query);
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Kedai Hawa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="page-container beranda-page">
        <!-- Header -->
        <div class="header-beranda">
            <div class="header-content">
                <img src="https://static.prod-images.emergentagent.com/jobs/11af06eb-deab-4fc3-acd8-8d0834568e32/images/de13689065d4c127b9f04e22ad0d7358461d53761dc0676680ddaa3560a7d413.png" alt="Logo" class="header-logo">
                <div class="header-text">
                    <h2 class="header-title">KEDAI HAWA</h2>
                    <p class="header-tagline">Pedas nampol bikin nagih</p>
                </div>
            </div>
            <button class="btn-menu" data-testid="menu-button">MENU</button>
        </div>
        
        <!-- Content -->
        <div class="content-wrapper-beranda">
            <?php foreach ($products as $product): ?>
            <div class="product-card" data-testid="product-card-<?php echo $product['id']; ?>">
                <div class="product-image-wrapper">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?php echo $product['name']; ?></h3>
                    <p class="product-desc"><?php echo $product['description']; ?></p>
                    <div class="product-footer">
                        <p class="product-price">Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        <a href="details.php?id=<?php echo $product['id']; ?>" class="btn-cart" data-testid="view-product-<?php echo $product['id']; ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 2L7.17 4H4C2.9 4 2 4.9 2 6V19C2 20.1 2.9 21 4 21H20C21.1 21 22 20.1 22 19V6C22 4.9 21.1 4 20 4H16.83L15 2H9Z" fill="#FF1493"/>
                                <circle cx="12" cy="13" r="3" fill="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Bottom Navigation -->
        <?php include '../includes/navbar.php'; ?>
    </div>
    
    <script src="../assets/js/script.js"></script>
</body>
</html>