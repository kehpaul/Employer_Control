<?php
session_start();
require("config.php");
$db = new mysqli ($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['ADMINNAME'])){
    $admin_id = $_SESSION['ADMINID'];
    if(isset($_POST['employ'])){
        header('location:employee.php');
    }
    if(isset($_POST['task'])){
        header('location:task.php');
    }
    if(isset($_POST['wallet'])){
        header('location:wallet.php');
    }
    if(isset($_POST['payment'])){
        header('location:payment.php');
    }
}
else{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1"/>
  <title>Kehpaul- Admin Dashboard </title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<p class="admin">Welcome to the Administrative Panel</p>
			<form method="post" action="" class="login up">
			<button type="submit" name="employ" class="button login__submit"><i class="button_icon left fas fa-user"></i>
			<span class="button_text">Add Employee</span>
			</button>
			<button type="submit" name="task" class="button login__submit"><i class="button_icon left fas fa-tasks"></i>
			<span class="button_text">Create Task</span>
			</button>
			<button type="submit" name="wallet" class="button login__submit"><i class="button_icon left fas fa-credit-card"></i>
			<span class="button_text">Wallet</span>
			</button>
			<button type="submit" name="payment" class="button login__submit"><i class="button_icon left fas fa-users"></i>
			<span class="button_text">Pay Employee</span>
			</button>
			</form>
			<div class="social-login">
				<h3>log in via</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<!-- partial -->
  
</body>
</html>
