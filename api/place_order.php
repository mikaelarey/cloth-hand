<?php
session_start();
require_once './connection.php';

$fullname = $_GET['fullname'];
$contact = $_GET['contact'];
$email = $_GET['email'];
$address = $_GET['address'];
$city = $_GET['city'];
$state = $_GET['state'];
$zip = $_GET['zip'];

$orderNumber = generate_order_number();

$sql = "UPDATE users SET contact = '" . $contact ."', email = '" . $email . "', address = '" . $address . "', city = '" . $city . "', state = '" . $state . "', zip = '" . $zip ."' WHERE id = " . $_SESSION['UserId'];

if ($conn->query($sql) === TRUE) {
    if (count($_SESSION['products_in_cart']) > 0 && isset($_SESSION['products_in_cart'])) {
        foreach ($_SESSION['products_in_cart'] as $item) {
            $sql = "INSERT INTO purchase (order_number, product_id, quantity, user_id) VALUES ('$orderNumber', " . $item['id'] . ", " . $item['quantity'] . ", " . $_SESSION['UserId'] . ")";
            $conn->query($sql);
        }

        unset($_SESSION['products_in_cart']);

        $_SESSION['address'] = ucwords(strtolower($address));
        $_SESSION['city'] = ucwords(strtolower($city));
        $_SESSION['state'] = ucwords(strtolower($state));
        $_SESSION['zip'] = ucwords(strtolower($zip));
        $_SESSION['contact'] = ucwords(strtolower($contact));
        $_SESSION['email'] = ucwords(strtolower($email));

        echo $orderNumber;
    } else {
        echo "No items on cart";
    }
} else {
    echo "Error updating user record"; //. $conn->error;
}

function generate_order_number() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < 100; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return md5($randomString);
}

$conn->close();

?>