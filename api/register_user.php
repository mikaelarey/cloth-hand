<?php
require_once './connection.php';

$username = $_GET['username'];
$password = $_GET['password'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];

$sql = "SELECT * FROM users WHERE username = '" . $username . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo 'exists';
} else {
    $sql = "INSERT INTO users (firstname, lastname, password, username) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $password . "', '" . $username . "')";

    // echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo 'inserted';
    } else {
        echo 'error';
    }
}

$conn->close();

?>