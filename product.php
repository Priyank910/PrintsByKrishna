<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();
if (!$product) {
    echo '<div class="container py-5"><p class="text-muted">Product not found.</p></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
?>
<div class="container py-5">
  <div class="row g-4">
    <div class="col-lg-6">
      <div class="ratio ratio-4x3 rounded-4 overflow-hidden card-elevated">
        <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-100 h-100 object-fit-cover">
      </div>
    </div>
    <div class="col-lg-6">
      <h2 class="text-darkblue"><?php echo htmlspecialchars($product['name']); ?></h2>
      <p class="text-muted"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
      <p class="h5 fw-bold">₹<?php echo number_format($product['price'], 2); ?></p>
      <form class="mt-3" method="post" action="<?php echo base_url(); ?>handlers/add_to_cart.php">
        <input type="hidden" name="id" value="<?php echo (int)$product['id']; ?>">
        <div class="input-group input-group-lg w-auto">
          <input type="number" name="quantity" value="1" min="1" class="form-control" required>
          <button class="btn btn-accent">Add to Cart</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
