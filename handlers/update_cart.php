<?php
require_once __DIR__ . '/../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $qty = (int)($_POST['quantity'] ?? 0);
    if (isset($_SESSION['cart'][$id])) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }
}
header('Location: ' . base_url() . 'cart.php');
exit;
?>
