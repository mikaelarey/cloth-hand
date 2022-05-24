<?php 
session_start();

// session_unset();
// session_destroy();

unset($_SESSION['UserId']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['address']);
unset($_SESSION['city']);
unset($_SESSION['state']);
unset($_SESSION['zip']);
unset($_SESSION['contact']);
unset($_SESSION['fullname']);

?>