<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$stmt = $pdo->query("SELECT id, name, price, category, image_path FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Products</h2>
    <form class="d-flex" method="get">
      <input class="form-control me-2" type="search" name="q" placeholder="Search products..." value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
      <button class="btn btn-outline-darkblue" type="submit">Search</button>
    </form>
  </div>
  <div class="row g-4">
    <?php
      $q = trim($_GET['q'] ?? '');
      if ($q !== '') {
        $stmt = $pdo->prepare("SELECT id, name, price, category, image_path FROM products WHERE name LIKE :q OR category LIKE :q ORDER BY created_at DESC");
        $stmt->execute([':q' => '%' . $q . '%']);
        $products = $stmt->fetchAll();
      }
      if (!$products) {
        echo '<p class="text-muted">No products found.</p>';
      }
      foreach ($products as $p):
    ?>
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
      <div class="card h-100 rounded-4 border-0 card-elevated">
        <div class="ratio ratio-4x3 rounded-top-4 overflow-hidden">
          <img src="<?php echo htmlspecialchars($p['image_path']); ?>" class="card-img-top object-fit-cover" alt="<?php echo htmlspecialchars($p['name']); ?>">
        </div>
        <div class="card-body">
          <h5 class="card-title text-darkblue"><?php echo htmlspecialchars($p['name']); ?></h5>
          <p class="card-text text-muted small mb-2"><?php echo htmlspecialchars($p['category'] ?: ''); ?></p>
          <p class="fw-semibold mb-3">₹<?php echo number_format($p['price'], 2); ?></p>
          <a href="product.php?id=<?php echo (int)$p['id']; ?>" class="btn btn-outline-darkblue w-100">View</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
