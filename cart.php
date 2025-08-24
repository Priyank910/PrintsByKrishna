<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<div class="container py-5">
  <h2 class="mb-4">Your Cart</h2>
  <?php if (!$cart): ?>
    <p class="text-muted">Your cart is empty. <a href="products.php">Browse products</a>.</p>
  <?php else: ?>
    <div class="table-responsive rounded-4 card-elevated">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th style="width: 180px;">Quantity</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $id => $item): ?>
          <tr>
            <td>
              <div class="d-flex align-items-center gap-3">
                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="" width="64" height="64" class="rounded-3 object-fit-cover">
                <div>
                  <div class="fw-semibold"><?php echo htmlspecialchars($item['name']); ?></div>
                  <div class="text-muted small"><?php echo htmlspecialchars($item['category'] ?? ''); ?></div>
                </div>
              </div>
            </td>
            <td>₹<?php echo number_format($item['price'], 2); ?></td>
            <td>
              <form class="d-flex" method="post" action="handlers/update_cart.php">
                <input type="hidden" name="id" value="<?php echo (int)$id; ?>">
                <input type="number" name="quantity" min="0" value="<?php echo (int)$item['quantity']; ?>" class="form-control me-2">
                <button class="btn btn-outline-darkblue btn-sm">Update</button>
              </form>
            </td>
            <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            <td>
              <form method="post" action="handlers/remove_from_cart.php">
                <input type="hidden" name="id" value="<?php echo (int)$id; ?>">
                <button class="btn btn-link text-danger p-0">Remove</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <div class="p-4 rounded-4 card-elevated" style="min-width: 320px;">
        <div class="d-flex justify-content-between mb-2">
          <span class="text-muted">Subtotal</span>
          <span>₹<?php echo number_format($total, 2); ?></span>
        </div>
        <hr>
        <div class="d-grid gap-2">
          <a href="checkout.php" class="btn btn-accent btn-lg">Proceed to Checkout</a>
          <form method="post" action="handlers/clear_cart.php">
            <button class="btn btn-outline-darkblue">Clear Cart</button>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
