<?php
require_once 'config/database.php';
$pageTitle='Home';
include 'includes/header.php';
include 'includes/navbar.php';
$featured = $pdo->query("SELECT * FROM packages ORDER BY id DESC LIMIT 3")->fetchAll();
?>
<section class="hero">
  <div class="hero-content">
    <span class="eyebrow">✦ Your Next Adventure Awaits</span>
    <h1>Explore the World <span>With Us</span></h1>
    <p>Discover amazing destinations, exclusive tour packages and unforgettable experiences designed for your perfect getaway.</p>
    <div class="search-box">
      <div class="search-item"><small>📍 DESTINATION</small><strong>Where to go?</strong></div>
      <div class="search-item"><small>🗓 CHECK IN</small><strong>Select date</strong></div>
      <div class="search-item"><small>🗓 CHECK OUT</small><strong>Select date</strong></div>
      <a class="btn btn-primary" href="packages.php">⌕ Search</a>
    </div>
  </div>
  
</section>

<section class="section container">
  <div class="section-head"><div class="section-kicker">Travel inspiration</div><h2>Popular Tour Packages</h2><p>Pick a destination and start making memories.</p></div>
  <div class="grid">
    <?php foreach($featured as $p): ?>
      <article class="card">
        <div class="card-img" style="background-image:url('<?= htmlspecialchars($p['image_url']) ?>')"><span class="price">From ₹<?= number_format($p['price']) ?></span></div>
        <div class="card-body">
          <h3><?= htmlspecialchars($p['title']) ?></h3>
          <div class="meta">📍 <?= htmlspecialchars($p['location']) ?> &nbsp; • &nbsp; <?= (int)$p['days'] ?> Days</div>
          <p class="desc"><?= htmlspecialchars($p['short_description']) ?></p>
          <div class="card-row"><span class="rating">★★★★★ <?= number_format($p['rating'],1) ?></span><a class="btn btn-primary btn-small" href="package-details.php?id=<?= $p['id'] ?>">View Package</a></div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
  <div style="text-align:center;margin-top:28px"><a class="btn btn-outline" href="packages.php">View All Packages →</a></div>
</section>
<?php include 'includes/footer.php'; ?>