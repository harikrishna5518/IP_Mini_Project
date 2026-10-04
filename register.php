<?php
require_once 'config/database.php';
if(session_status()===PHP_SESSION_NONE)session_start();
if(!empty($_SESSION['user_id'])){header('Location:index.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $phone=trim($_POST['phone']??''); $pass=$_POST['password']??'';
 if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pass)<6) $error='Enter valid details. Password must be at least 6 characters.';
 else{
  $check=$pdo->prepare("SELECT id FROM users WHERE email=?");$check->execute([$email]);
  if($check->fetch()) $error='Email already registered.';
  else{$stmt=$pdo->prepare("INSERT INTO users(name,email,phone,password) VALUES(?,?,?,?)");$stmt->execute([$name,$email,$phone,password_hash($pass,PASSWORD_DEFAULT)]);$_SESSION['user_id']=$pdo->lastInsertId();$_SESSION['user_name']=$name;header('Location:index.php');exit;}
 }
}
$pageTitle='Register';include 'includes/header.php';include 'includes/navbar.php';
?>
<div class="form-page"><div class="auth-box glass"><div class="auth-head"><span class="brand-icon" style="display:inline-grid">✈</span><h1>Create Your Account</h1><p>Join us and start your journey.</p></div>
<?php if($error): ?><div class="alert alert-error flash" style="width:100%;margin:0 0 15px"><?= htmlspecialchars($error) ?></div><?php endif;?>
<form method="post"><div class="field"><label>FULL NAME</label><input name="name" required placeholder="Enter your name"></div><div class="field"><label>EMAIL ADDRESS</label><input type="email" name="email" required placeholder="Enter your email"></div><div class="field"><label>PHONE NUMBER</label><input name="phone" placeholder="Enter your phone number"></div><div class="field"><label>PASSWORD</label><input type="password" name="password" required placeholder="Create a password"></div><button class="btn btn-primary full">Register</button></form><div class="helper">Already have an account? <a href="login.php">Login</a></div></div></div>
<?php include 'includes/footer.php'; ?>