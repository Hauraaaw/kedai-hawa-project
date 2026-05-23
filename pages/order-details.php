<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';
/** @var mysqli $conn */

// Ambil cart items dari session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

// Ambil detail produk dari database
$cart_items = [];

if (!empty($cart)) {

    foreach ($cart as $product_id => $quantity) {

        $query = "SELECT * FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $query);

        $product = mysqli_fetch_assoc($result);

        if ($product) {

            $product['quantity'] = $quantity;
            $product['subtotal'] = $product['price'] * $quantity;

            $total += $product['subtotal'];

            $cart_items[] = $product;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Kedai Hawa</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="page-container order-details-page">

    <!-- HEADER -->
    <div class="header-page">

        <a href="beranda.php" class="btn-back">

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M15 18L9 12L15 6"
                    stroke="#FF1493"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"/>
            </svg>

        </a>

        <h2 class="page-title">ORDER DETAILS</h2>

        <a href="order-details.php" class="btn-cart-icon">

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">

                <path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.25 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.28 15 7.17 14.89 7.17 14.75L7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L20.88 5.48C20.96 5.34 21 5.17 21 5C21 4.45 20.55 4 20 4H5.21L4.27 2H1ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z"
                    fill="#FF1493"/>

            </svg>

        </a>

    </div>

    <!-- CONTENT -->
    <div class="order-content">

        <?php if (empty($cart_items)): ?>

            <div class="order-card">

                <div class="empty-cart">

                    <p>Keranjang Anda kosong 😭</p>

                    <a href="beranda.php" class="btn-back-menu">
                        Kembali ke Menu
                    </a>

                </div>

            </div>

        <?php else: ?>

            <!-- LOOP ITEM -->
            <?php foreach ($cart_items as $item): ?>

                <div class="order-card">

                    <div class="order-item">

                        <!-- IMAGE -->
                        <div class="order-item-image">

                            <img
                                src="<?php echo $item['image']; ?>"
                                alt="<?php echo $item['name']; ?>"
                            >

                        </div>

                        <!-- INFO -->
                        <div class="order-item-info">

                            <h3 class="order-item-name">
                                <?php echo $item['name']; ?>
                            </h3>

                            <p class="order-item-desc">
                                <?php echo $item['description']; ?>
                            </p>

                            <p class="order-item-price">
                                Rp.
                                <?php echo number_format($item['price'], 0, ',', '.'); ?>
                            </p>

                        </div>

                        <!-- QTY -->
                        <div class="order-item-qty">

                            <span class="qty-badge">
                                +<?php echo $item['quantity']; ?>
                            </span>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

            <!-- TOTAL -->
            <div class="order-total">

                <span class="total-label">
                    Total Harga
                </span>

                <span class="total-price">
                    Rp. <?php echo number_format($total, 0, ',', '.'); ?>
                </span>

            </div>

            <!-- CHECKOUT -->
            <form action="../api/checkout.php" method="POST">

                <button
                    type="submit"
                    class="btn-checkout">

                    CHECKOUT

                </button>

            </form>

        <?php endif; ?>

    </div>

    <!-- NAVBAR -->
    <?php include '../includes/navbar.php'; ?>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>