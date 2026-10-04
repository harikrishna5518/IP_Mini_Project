<?php
require_once 'config/database.php';
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare("SELECT * FROM packages WHERE id=?"); $stmt->execute([$id]); $p=$stmt->fetch();
if(!$p){header("Location: packages.php");exit;}
$pageTitle=$p['title']; include 'includes/header.php'; include 'includes/navbar.php';
?>
<section class="container" style="padding-top:22px">
 <div class="detail-hero" style="background-image:url('<?= htmlspecialchars($p['image_url']) ?>')"><div class="detail-overlay"><div><div class="meta" style="color:#dce9ff">📍 <?= htmlspecialchars($p['location']) ?> &nbsp; • &nbsp; ★ <?= number_format($p['rating'],1) ?></div><h1><?= htmlspecialchars($p['title']) ?></h1></div><div style="margin-left:auto;text-align:right"><small>From</small><div style="font-size:28px;font-weight:800">₹<?= number_format($p['price']) ?></div></div></div></div>
 <div class="detail-grid">
  <div class="glass-panel"><h2>About This Package</h2><p style="margin-top:10px;color:#66758d;font-size:13px"><?= nl2br(htmlspecialchars($p['description'])) ?></p><div class="icon-list"><div class="icon-box">◷<b>Duration</b><?= $p['days'] ?> Days / <?= max(1,$p['days']-1) ?> Nights</div><div class="icon-box">♙<b>Group Size</b>2 - 10 People</div><div class="icon-box">✓<b>Included</b>Hotel + Breakfast</div><div class="icon-box">⌖<b>Pickup & Drop</b>Airport / Transfer</div></div></div>
  <div class="glass-panel"><div class="price-big">₹<?= number_format($p['price']) ?> <span>per person</span></div><p class="desc" style="margin-top:7px">Secure your trip today and get ready for an unforgettable experience.</p><a class="btn btn-primary full" href="book.php?id=<?= $p['id'] ?>">Book Now →</a><div class="check">✓ <b>Free cancellation</b> on selected dates</div><div class="check">✓ <b>Instant confirmation</b></div><div class="check">✓ <b>24/7 support</b></div></div>
 </div>
</section>
<?php include 'includes/footer.php'; ?>