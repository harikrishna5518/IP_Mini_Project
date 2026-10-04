<?php
require_once 'config/database.php';
if(session_status()===PHP_SESSION_NONE)session_start();
if(empty($_SESSION['user_id'])){header('Location:login.php');exit;}
$id=(int)($_GET['id']??$_POST['package_id']??0);
$stmt=$pdo->prepare("SELECT * FROM packages WHERE id=?");$stmt->execute([$id]);$p=$stmt->fetch();if(!$p){header('Location:packages.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $people=max(1,(int)($_POST['people']??1));$date=$_POST['travel_date']??'';$phone=trim($_POST['phone']??'');$notes=trim($_POST['notes']??'');
 if(!$date||!$phone)$error='Please fill all required fields.';
 elseif($date<date('Y-m-d'))$error='Travel date must be today or a future date.';
 else{$total=$people*$p['price'];$stmt=$pdo->prepare("INSERT INTO bookings(user_id,package_id,travel_date,people,phone,total_amount,notes,status) VALUES(?,?,?,?,?,?,?,'Pending')");$stmt->execute([$_SESSION['user_id'],$p['id'],$date,$people,$phone,$total,$notes]);header('Location:booking-success.php?id='.$pdo->lastInsertId());exit;}
}
$pageTitle='Book '.$p['title'];include 'includes/header.php';include 'includes/navbar.php';
?>
<section class="container section" style="padding-top:35px"><div class="booking-layout">
<div class="glass-panel"><div class="summary-img" style="background-image:url('<?= htmlspecialchars($p['image_url']) ?>')"></div><h2><?= htmlspecialchars($p['title']) ?></h2><div class="meta">📍 <?= htmlspecialchars($p['location']) ?> • <?= $p['days'] ?> Days</div><p class="desc"><?= htmlspecialchars($p['short_description']) ?></p><div class="summary-price">₹<?= number_format($p['price']) ?> <span style="font-size:11px;color:#74839a">/ person</span></div></div>
<div class="booking-card glass"><h2>Book Your Trip</h2>
<?php if($error): ?><div class="alert alert-error flash" style="width:100%;margin:0 0 15px"><?= htmlspecialchars($error) ?></div><?php endif;?>
<form method="post"><input type="hidden" name="package_id" value="<?= $p['id'] ?>"><div class="field"><label>FULL NAME</label><input value="<?= htmlspecialchars($_SESSION['user_name']??'') ?>" disabled></div><div class="field"><label>PHONE NUMBER *</label><input name="phone" required placeholder="Enter your phone number"></div><div class="form-row"><div class="field"><label>NUMBER OF PEOPLE *</label><input type="number" name="people" min="1" max="20" value="1" required></div><div class="field"><label>TRAVEL DATE *</label><input type="date" name="travel_date" min="<?= date('Y-m-d') ?>" required></div></div><div class="field"><label>ADDITIONAL NOTES</label><textarea name="notes" placeholder="Any special requests?"></textarea></div><button class="btn btn-primary full">Confirm Booking →</button></form></div>
</div></section>
<?php include 'includes/footer.php'; ?>