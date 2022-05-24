<?php
session_start();

$id = $_GET['id'];

foreach ($_SESSION['products_in_cart'] as $key => $item) {
    if ($item["id"] == $id) {
        unset($_SESSION['products_in_cart'][$key]);
        break;
    }
}

echo count($_SESSION['products_in_cart']);

?>