<?php
require_once 'config/database.php';
if(session_status()===PHP_SESSION_NONE)session_start();if(empty($_SESSION['user_id'])){header('Location:login.php');exit;}
$stmt=$pdo->prepare("SELECT b.*,p.title,p.location,p.image_url FROM bookings b JOIN packages p ON p.id=b.package_id WHERE b.user_id=? ORDER BY b.created_at DESC");$stmt->execute([$_SESSION['user_id']]);$bookings=$stmt->fetchAll();
$pageTitle='My Bookings';include 'includes/header.php';include 'includes/navbar.php';
?>
<div class="container page-title"><div class="section-kicker">Your journeys</div><h1>My Bookings</h1><p>Track all your upcoming and previous trips.</p></div>
<section class="container section" style="padding-top:10px"><div class="glass-panel table-wrap"><table class="table"><thead><tr><th>Package</th><th>Date</th><th>People</th><th>Total</th><th>Status</th></tr></thead><tbody>
<?php if(!$bookings): ?><tr><td colspan="5" style="text-align:center;padding:35px">No bookings yet. <a href="packages.php" style="color:#2674ed;font-weight:700">Explore packages →</a></td></tr><?php endif;?>
<?php foreach($bookings as $b): ?><tr><td><b><?= htmlspecialchars($b['title']) ?></b><br><small><?= htmlspecialchars($b['location']) ?></small></td><td><?= htmlspecialchars($b['travel_date']) ?></td><td><?= (int)$b['people'] ?></td><td>₹<?= number_format($b['total_amount']) ?></td><td><span class="status <?= strtolower($b['status']) ?>"><?= htmlspecialchars($b['status']) ?></span></td></tr><?php endforeach;?>
</tbody></table></div></section>
<?php include 'includes/footer.php'; ?>