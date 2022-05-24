<?php
session_start();

$id = $_GET['id'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];
$image = $_GET['image'];
$name = $_GET['name'];

if (isset($_SESSION['products_in_cart'])) {
    $index = 0;
    $isExists = false;

    foreach ($_SESSION['products_in_cart'] as $item) {
        if ($item["id"] == $id) {
            $_SESSION['products_in_cart'][$index]["quantity"] += $quantity;
            $isExists = true;
            break;
        }
    }

    if ($isExists == false) {
        $product = array(
            "id" => $id, 
            "quantity" => $quantity,
            "price" => $price,
            "image" => $image,
            "name" => $name
        );
        array_push($_SESSION['products_in_cart'], $product);
    }
}
else {
    $_SESSION['products_in_cart'] = array();
    $product = array(
        "id" => $id, 
        "quantity" => $quantity,
        "price" => $price,
        "image" => $image,
        "name" => $name
    );
    array_push($_SESSION['products_in_cart'], $product);
}

echo count($_SESSION['products_in_cart']);

?>