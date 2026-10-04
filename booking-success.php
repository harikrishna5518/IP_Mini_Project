<?php
require_once 'config/database.php';
if(session_status()===PHP_SESSION_NONE)session_start();if(empty($_SESSION['user_id'])){header('Location:login.php');exit;}
$id=(int)($_GET['id']??0);$stmt=$pdo->prepare("SELECT b.*,p.title FROM bookings b JOIN packages p ON p.id=b.package_id WHERE b.id=? AND b.user_id=?");$stmt->execute([$id,$_SESSION['user_id']]);$b=$stmt->fetch();
$pageTitle='Booking Confirmed';include 'includes/header.php';include 'includes/navbar.php';
?>
<div class="form-page"><div class="auth-box glass" style="text-align:center"><div style="font-size:55px">✓</div><h1 style="margin:10px 0">Booking Submitted!</h1><p style="color:#68788f;font-size:13px">Your booking for <b><?= htmlspecialchars($b['title']??'your trip') ?></b> has been received.</p><div class="glass-panel" style="margin:20px 0;text-align:left"><div class="check">🧾 <b>Booking ID:</b> #<?= (int)$id ?></div><div class="check">🗓 <b>Date:</b> <?= htmlspecialchars($b['travel_date']??'') ?></div><div class="check">♙ <b>People:</b> <?= (int)($b['people']??0) ?></div><div class="check">💰 <b>Total:</b> ₹<?= number_format($b['total_amount']??0) ?></div></div><a class="btn btn-primary" href="my-bookings.php">View My Bookings</a></div></div>
<?php include 'includes/footer.php'; ?>