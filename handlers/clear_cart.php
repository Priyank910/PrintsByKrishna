<?php
require_once __DIR__ . '/../config.php';
$_SESSION['cart'] = [];
header('Location: ' . base_url() . 'cart.php');
exit;
?>
