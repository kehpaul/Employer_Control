<?php
session_start();
require("config.php");
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbdatabase);


$usernameErr = $passwordErr = $e = "";
$username = $password = $passwordhash = $pass = "";
//this is where we determine if a user has logged in and where to send them.
function test_input($formdata)
{
	$formdata = trim($formdata);
	$formdata = stripslashes($formdata);
	$formdata = htmlspecialchars($formdata);
	return $formdata;
}




if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	
  // the username of the admin is left empty
	if (empty($_POST['username']))
	{
		$usernameErr = "* Useename is required";
	}
	else
	{
	    //checking the input for security purpose
		$username = test_input($_POST['username']);
		
		if (!preg_match('/^[\w]+$/', $username))
		{
			$usernameErr = "* Only letters and numbers allowed";
		}
	}
  
   //if admin password is empty

	if (empty($_POST['password']))
	{
		$passwordErr = "* password is required";
	}
	
	

	if(empty($usernameErr))
	{
		if(empty($passwordErr))
		{
If(isset($_POST['username']))
{
	$user = $_POST['username'];
	
	//fetching the admin account
	$usersql = "SELECT * FROM employee WHERE username = '{$user}'";
	$userresult = mysqli_query($db, $usersql);
	$userrow = mysqli_fetch_assoc($userresult);
	$checknumrows = mysqli_num_rows($userresult);
	$passwordhash = $userrow['password'];
	$pass = $_POST['password'];
	if(password_verify($pass, $passwordhash)){
	    //checking if the admin has accoy
	if($checknumrows == 0)
	{
		$e=1;
	}
	

	else{
		$_SESSION['EMPLOYEE'] = $userrow['username'];
		$_SESSION['EMPLOYEEID'] = $userrow['id'];
		
		if(isset($_SESSION['EMPLOYEE']))
		{
			if(isset($_SESSION['EMPLOYEEID']))
			{
$updatelog = "UPDATE employee SET log='online' WHERE id='{$_SESSION['EMPLOYEEID']}' ";
$log = mysqli_query($db,$updatelog);
$time = date("d-m-y H:i:s", time());
$last_log = "UPDATE employee SET lastlog= '{$time}' WHERE id='{$_SESSION['EMPLOYEEID']}' " ;
$updatelast_log = mysqli_query($db,$last_log);
				
				
				
				header("Location:" . $config_basedir . "index.php");
				exit();
				
				
				}
		}
	}
	}
	}
	else{
		$e=1;
		}
	
}
		}
	}


//defining errors
if (isset($e))
{
	
	if(is_numeric($e)){
	if($e == 1)
	{

	$errmes= "<div class='error' style='color:hotpink'>
		<br />Incorrect Username/Password</font><br/> contact the tech support team if you've forgotten your access </div>";
	}

		
}

}
else{
header("Location:" . $config_basedir . "index.php");
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
			<form class="login" action=" "  method="post">
			    <?php echo $errmes; ?>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<span class="error"><?php echo $usernameErr; ?></span>
					<input type="text" class="login__input" name="username" placeholder="User name">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<span class="error"><?php echo $passwordErr; ?></span>
					<input type="password" class="login__input" name="password" placeholder="Password">
				</div>
				<button class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
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
