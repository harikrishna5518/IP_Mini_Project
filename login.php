<?php
require_once 'config/database.php';
if(session_status()===PHP_SESSION_NONE)session_start();
if(!empty($_SESSION['user_id'])){header('Location:index.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=trim($_POST['email']??'');$pass=$_POST['password']??'';
 $stmt=$pdo->prepare("SELECT * FROM users WHERE email=?");$stmt->execute([$email]);$u=$stmt->fetch();
 if($u && password_verify($pass,$u['password'])){$_SESSION['user_id']=$u['id'];$_SESSION['user_name']=$u['name'];$_SESSION['role']=$u['role']; if($u['role']==='admin')header('Location:admin/dashboard.php');else header('Location:index.php');exit;}
 $error='Invalid email or password.';
}
$pageTitle='Login';include 'includes/header.php';include 'includes/navbar.php';
?>
<div class="form-page"><div class="auth-box glass"><div class="auth-head"><span class="brand-icon" style="display:inline-grid">✈</span><h1>Welcome Back</h1><p>Login to your account.</p></div>
<?php if($error): ?><div class="alert alert-error flash" style="width:100%;margin:0 0 15px"><?= htmlspecialchars($error) ?></div><?php endif;?>
<form method="post"><div class="field"><label>EMAIL OR USERNAME</label><input type="email" name="email" required placeholder="Enter your email"></div><div class="field"><label>PASSWORD</label><input type="password" name="password" required placeholder="Enter your password"></div><button class="btn btn-primary full">Login</button></form><div class="helper">Don't have an account? <a href="register.php">Register</a></div><div class="helper" style="margin-top:8px">Demo admin: admin@tourtravel.com / admin123</div></div></div>
<?php include 'includes/footer.php'; ?>