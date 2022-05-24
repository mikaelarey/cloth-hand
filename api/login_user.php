<?php
session_start();

require_once './connection.php';

$username = $_GET['username'];
$password = $_GET['password'];

$sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $_SESSION['UserId'] = $row["id"];
    $_SESSION['firstname'] = ucwords(strtolower($row["firstname"])); 
    $_SESSION['lastname'] = ucwords(strtolower($row["lastname"]));
    $_SESSION['address'] = ucwords(strtolower($row["address"]));
    $_SESSION['city'] = ucwords(strtolower($row["city"]));
    $_SESSION['state'] = ucwords(strtolower($row["state"]));
    $_SESSION['zip'] = ucwords(strtolower($row["zip"]));
    $_SESSION['contact'] = ucwords(strtolower($row["contact"]));
    $_SESSION['fullname'] = ucwords(strtolower($row["firstname"] . ' ' . $row["lastname"]));
    $_SESSION['email'] = strtolower($row["email"]);
  }

  echo 'success';
} else {
  echo 'failed';
}

$conn->close();