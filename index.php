<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>
<header class="hero container py-5">
  <div class="row align-items-center g-4">
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold text-darkblue">Art & Event Cards crafted with love in Ahmedabad</h1>
      <p class="lead mt-3 text-muted">Custom greetings, digital & physical prints, and personalized designs for every moment.</p>
      <div class="mt-4 d-flex gap-2">
        <a href="products.php" class="btn btn-accent btn-lg">Explore Products</a>
        <a href="#about" class="btn btn-outline-darkblue btn-lg">Why PrintsByKrishna?</a>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="hero-card p-4 rounded-4">
        <div class="ratio ratio-16x9 rounded-4 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1920&auto=format&fit=crop" alt="Art Cards" class="w-100 h-100 object-fit-cover">
        </div>
      </div>
    </div>
  </div>
</header>

<section id="about" class="container py-5">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="p-4 rounded-4 card-elevated h-100">
        <h5 class="mb-2">Customizable</h5>
        <p class="mb-0 text-muted">We tailor cards to your story—names, dates, styles, and special messages.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-4 rounded-4 card-elevated h-100">
        <h5 class="mb-2">Digital & Physical</h5>
        <p class="mb-0 text-muted">Instant digital files, or beautiful physical prints via local partners.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-4 rounded-4 card-elevated h-100">
        <h5 class="mb-2">Artist-led</h5>
        <p class="mb-0 text-muted">Each piece is designed in-house for a truly unique, heartfelt finish.</p>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
