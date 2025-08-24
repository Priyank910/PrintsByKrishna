<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Very basic validation
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $address && $cart) {
        // In a real app, save order to DB and process payment here.
        $_SESSION['cart'] = [];
        $success = true;
    }
}
?>
<div class="container py-5">
  <h2 class="mb-4">Checkout</h2>
  <?php if ($success): ?>
    <div class="alert alert-success rounded-4">Thank you! Your order has been placed.</div>
    <a href="products.php" class="btn btn-accent">Continue Shopping</a>
  <?php elseif (!$cart): ?>
    <p class="text-muted">Your cart is empty.</p>
    <a href="products.php" class="btn btn-outline-darkblue">Browse Products</a>
  <?php else: ?>
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="p-4 rounded-4 card-elevated">
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea name="address" rows="4" class="form-control" required></textarea>
            </div>
            <button class="btn btn-accent btn-lg">Place Order</button>
          </form>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="p-4 rounded-4 card-elevated">
          <h5 class="mb-3">Order Summary</h5>
          <ul class="list-unstyled mb-3">
            <?php foreach ($cart as $item): ?>
              <li class="d-flex justify-content-between">
                <span><?php echo htmlspecialchars($item['name']); ?> × <?php echo (int)$item['quantity']; ?></span>
                <span>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
          <hr>
          <div class="d-flex justify-content-between">
            <strong>Total</strong>
            <strong>₹<?php echo number_format($total, 2); ?></strong>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
