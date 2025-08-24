<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: index.php');
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Validate
    if ($name === '') $errors[] = 'Name is required';
    if ($price <= 0) $errors[] = 'Price must be greater than 0';

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['image/jpeg' => '.jpg', 'image/png' => '.png', 'image/webp' => '.webp'];
        $mime = mime_content_type($_FILES['image']['tmp_name']);
        if (!isset($allowed[$mime])) {
            $errors[] = 'Image must be JPG, PNG, or WEBP';
        } else {
            $ext = $allowed[$mime];
            $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower(pathinfo($_FILES['image']['name'], PATHINFO_FILENAME)));
            $filename = $safeName . '-' . time() . $ext;
            $destination = __DIR__ . '/../uploads/' . $filename;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $errors[] = 'Failed to save uploaded image';
            } else {
                $imagePath = 'uploads/' . $filename;
            }
        }
    } else {
        $errors[] = 'Product image is required';
    }

    if (!$errors) {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, category, description, image_path) VALUES (:name, :price, :category, :description, :image_path)");
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':category' => $category,
            ':description' => $description,
            ':image_path' => $imagePath,
        ]);
        $success = true;
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container py-5">
  <div class="row g-4">
    <div class="col-lg-7">
      <div class="p-4 rounded-4 card-elevated">
        <h3 class="text-darkblue mb-3">Add Product</h3>
        <?php if ($success): ?>
          <div class="alert alert-success rounded-4">Product added successfully!</div>
        <?php endif; ?>
        <?php if ($errors): ?>
          <div class="alert alert-danger rounded-4">
            <ul class="mb-0">
              <?php foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price (INR)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" accept="image/*" class="form-control" required>
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-accent">Add Product</button>
            <a class="btn btn-outline-darkblue" href="list_products.php">View All</a>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="p-4 rounded-4 card-elevated">
        <h5 class="mb-2">Tips</h5>
        <ul class="small text-muted mb-0">
          <li>Use high-resolution images, 4:3 aspect ratio recommended.</li>
          <li>Good naming improves search (e.g., “Diwali Greeting – Floral”).</li>
          <li>Price in INR; decimals allowed.</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
