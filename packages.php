<?php
require_once 'config/database.php';
$pageTitle='Packages';
include 'includes/header.php'; include 'includes/navbar.php';
$cat = trim($_GET['category'] ?? '');
if($cat){
  $stmt=$pdo->prepare("SELECT * FROM packages WHERE category=? ORDER BY id DESC"); $stmt->execute([$cat]); $packages=$stmt->fetchAll();
}else $packages=$pdo->query("SELECT * FROM packages ORDER BY id DESC")->fetchAll();
$categories=$pdo->query("SELECT DISTINCT category FROM packages ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="container page-title"><div class="section-kicker">Choose your journey</div><h1>Tour Packages</h1><p>Handpicked trips for beaches, mountains, culture and adventure.</p></div>
<div class="container filterbar">
  <a class="chip <?= !$cat?'active':'' ?>" href="packages.php">All</a>
  <?php foreach($categories as $c): ?><a class="chip <?= $cat===$c?'active':'' ?>" href="?category=<?= urlencode($c) ?>"><?= htmlspecialchars($c) ?></a><?php endforeach; ?>
</div>
<section class="container section" style="padding-top:10px"><div class="grid">
<?php foreach($packages as $p): ?>
<article class="card">
 <div class="card-img" style="background-image:url('<?= htmlspecialchars($p['image_url']) ?>')"><span class="price">₹<?= number_format($p['price']) ?></span></div>
 <div class="card-body"><h3><?= htmlspecialchars($p['title']) ?></h3><div class="meta">📍 <?= htmlspecialchars($p['location']) ?> • <?= $p['days'] ?> Days / <?= max(1,$p['days']-1) ?> Nights</div><p class="desc"><?= htmlspecialchars($p['short_description']) ?></p><div class="card-row"><span class="rating">★★★★★ <?= number_format($p['rating'],1) ?></span><a class="btn btn-primary btn-small" href="package-details.php?id=<?= $p['id'] ?>">Explore →</a></div></div>
</article>
<?php endforeach; ?>
</div></section>
<?php include 'includes/footer.php'; ?>