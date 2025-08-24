<?php
// includes/navbar.php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-cream border-bottom subtle-shadow sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-darkblue" href="<?php echo base_url(); ?>">PrintsByKrishna</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/PrintsByKrishna/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/PrintsByKrishna/products.php">Products</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/PrintsByKrishna/cart.php">Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PrintsByKrishna/admin/">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
