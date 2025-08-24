<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-darkblue mb-0">All Products</h3>
    <a href="add_product.php" class="btn btn-accent">Add New</a>
  </div>
  <div class="table-responsive rounded-4 card-elevated">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
          <td><?php echo (int)$p['id']; ?></td>
          <td><img src="../<?php echo htmlspecialchars($p['image_path']); ?>" width="64" height="64" class="rounded-3 object-fit-cover"></td>
          <td><?php echo htmlspecialchars($p['name']); ?></td>
          <td><?php echo htmlspecialchars($p['category']); ?></td>
          <td>₹<?php echo number_format($p['price'], 2); ?></td>
          <td>
            <form method="post" action="delete_product.php" onsubmit="return confirm('Delete this product?')">
              <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
              <button class="btn btn-link text-danger p-0">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
