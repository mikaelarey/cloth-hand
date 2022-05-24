<?php 
session_start();

// session_unset();
// session_destroy();

require 'api/connection.php';
require 'models/Product.php';

$cart_count = isset($_SESSION['products_in_cart']) 
            ? count($_SESSION['products_in_cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tech2etc Ecommerce Website</title>
	<script src="https://kit.fontawesome.com/43d25964f6.js"></script>
	<link rel="stylesheet" href="style.css">

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button.button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button.button:hover {
            opacity: 0.8;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 13px 18px;
            background-color: #f44336;
            border: unset;
            color: white

        }

        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.avatar {
            width: 15rem;
            border-radius: 50%;
        }

        .container {
        padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 40rem;
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)} 
            to {-webkit-transform: scale(1)}
        }
        
        @keyframes animatezoom {
            from {transform: scale(0)} 
            to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="./sweetalert2.min.css">
</head>

<body onload="page_load()">
    <section id="header">
		<a href="#"><img src="imgs/logo.jpg" class="logo" height="80" alt="" ></a>
		<div>
			<ul id="navbar" style="z-index:99;">
				<li><a href="index.php">Home</a></li>
				<li><a href="shop.php">Shop</a></li>
                <li><a href="history.php">Order History</a></li>
                <li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0): ?>
                    <li><a href="#" onclick="logout()">Logout</a></li>
                <?php else: ?>
                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
                <?php endif; ?>
				<li id="lg-bag">
                    <a href="cart.php" class="relative">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="cart-count" id="cart_count1">
                            <?php echo $cart_count; ?>
                        </span>
                    </a>
                </li>
				<a href="#" id="close"><i class="fa-solid fa-x"></i></a>
			</ul>
		</div>
		<div id="mobile">
			<a href="cart.php" class="relative">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count cart-count-mobile" id="cart_count2">
                    <?php echo $cart_count; ?>
                </span>
            </a>
			<i id="bar" class="fas fa-outdent"></i>
		</div>
	</section>