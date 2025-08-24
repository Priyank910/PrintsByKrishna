<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $qty = max(1, (int)($_POST['quantity'] ?? 1));

    $stmt = $pdo->prepare("SELECT id, name, price, category, image_path FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $p = $stmt->fetch();

    if ($p) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'name' => $p['name'],
                'price' => (float)$p['price'],
                'category' => $p['category'],
                'image' => $p['image_path'],
                'quantity' => 0,
            ];
        }
        $_SESSION['cart'][$id]['quantity'] += $qty;
    }
}
header('Location: ' . base_url() . 'cart.php');
exit;
?>
