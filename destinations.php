<?php
require_once 'config/database.php';
$pageTitle='Destinations';
include 'includes/header.php'; include 'includes/navbar.php';
$destinations=$pdo->query("SELECT * FROM destinations ORDER BY id DESC")->fetchAll();
?>
<div class="container page-title"><div class="section-kicker">Wander farther</div><h1>Popular Destinations</h1><p>Explore beautiful places around the world.</p></div>
<section class="container section" style="padding-top:15px"><div class="grid">
<?php foreach($destinations as $d): ?>
<article class="card"><div class="card-img" style="background-image:url('<?= htmlspecialchars($d['image_url']) ?>')"></div><div class="card-body"><h3><?= htmlspecialchars($d['name']) ?></h3><div class="meta"><?= htmlspecialchars($d['country']) ?> • <?= htmlspecialchars($d['category']) ?></div><p class="desc"><?= htmlspecialchars($d['description']) ?></p><a class="btn btn-primary btn-small" href="packages.php?category=<?= urlencode($d['category']) ?>">View Trips →</a></div></article>
<?php endforeach; ?>
</div></section>
<?php include 'includes/footer.php'; ?>