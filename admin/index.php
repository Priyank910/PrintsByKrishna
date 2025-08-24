<?php
require_once __DIR__ . '/../config.php';

$logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    if ($_POST['username'] === ADMIN_USERNAME && $_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: add_product.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}

if ($logged_in) {
    header('Location: add_product.php');
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container py-5" style="max-width: 520px;">
  <div class="p-4 rounded-4 card-elevated">
    <h3 class="mb-3 text-darkblue">Admin Login</h3>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger rounded-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-accent w-100">Login</button>
    </form>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
