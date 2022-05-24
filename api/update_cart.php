<?php
session_start();

$id = $_GET['id'];
$quantity = $_GET['quantity'];

foreach ($_SESSION['products_in_cart'] as $key => $item) {
    if ($item["id"] == $id) {
        $_SESSION['products_in_cart'][$key]["quantity"] = (empty($quantity) || $quantity < 1) ? 1 : $quantity;
        break;
    }
}

echo count($_SESSION['products_in_cart']);
?>