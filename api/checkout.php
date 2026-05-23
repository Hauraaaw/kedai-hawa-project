<?php
session_start();
require_once '../config/database.php';
/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
    if (empty($cart)) {
        header('Location: ../pages/order-details.php');
        exit();
    }
    
    // Hitung total
    $total = 0;
    foreach ($cart as $product_id => $quantity) {
        $query = "SELECT price FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);
        if ($product) {
            $total += $product['price'] * $quantity;
        }
    }
    
    // Insert order
    $query = "INSERT INTO orders (user_id, total_price, status, created_at) VALUES ($user_id, $total, 'pending', NOW())";
    mysqli_query($conn, $query);
    $order_id = mysqli_insert_id($conn);
    
    // Insert order items
    foreach ($cart as $product_id => $quantity) {
        $query = "SELECT price FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);
        if ($product) {
            $price = $product['price'];
            $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
            mysqli_query($conn, $query);
        }
    }
    
    // Kosongkan cart
    $_SESSION['cart'] = [];
    
    header('Location: ../pages/confirm-order.php');
    exit();
}
?>