<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    // Delete image file as well
    $stmt = $pdo->prepare("SELECT image_path FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    if ($row = $stmt->fetch()) {
        $img = __DIR__ . '/../' . $row['image_path'];
        if (is_file($img)) @unlink($img);
    }
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
header('Location: list_products.php');
exit;
?>
