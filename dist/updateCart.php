<?php
session_start();
require_once ('functions.php');
setCart();
    if (isset($_POST['addToCart'])) {
        $productId = $_GET['productid'];
        $orderAmount = $_POST['orderamount'];
     
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$productId])) {
            // If it exists, update the quantity instead of overwriting
            $_SESSION['cart'][$productId] += $orderAmount;
        } else {
            // If it doesn't exist, add it to the cart
            $_SESSION['cart'][$productId] = $orderAmount;
        }
        header('Location: detailpage.php?productid='.$productId);
    }

    if (isset($_POST['productAmount'])) {
        $productId = $_GET['productid'];
        $_SESSION['cart'][$productId] = $_POST['productAmount'];
        header('Location: winkelwagen.php');
    }

    if (isset($_POST['delFromCart'])) {
        $productId = $_GET['productid'];
        if (isset($_SESSION['cart'][$productId])) {
           unset($_SESSION['cart'][$productId]);
        }
        header('Location: winkelwagen.php');
    }

?>