<?php
require_once './connection.php';

$sql = "SELECT * FROM users WHERE username = '" . $_GET['username'] . "'";
$result = $conn->query($sql);

echo ($result->num_rows > 0) ? 1 : 0;

$conn->close();
?>