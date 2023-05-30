<?php
session_start();

// Clear the cart
$_SESSION['cart'] = array();

// Redirect to the thank_you page
header('Location: thank_you.php');
exit();
?>