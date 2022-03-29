<?php
session_start();
require ("configure.php");
$db = new mysqli($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['EMPLOYEE'])){
    $employee_id = $_SESSION['EMPLOYEEID'];
    //checking admin balance
    $walletsql = "SELECT SUM(amount) AS total FROM wallet WHERE employee_id='{$admin_id}'";
    $fetchwallet = mysqli_query($db,$walletsql);
    $wallet = mysqli_fetch_assoc($fetchwallet);
    $wallettotal = $wallet['total'];
    //checking admin expenses
    $expensessql = "SELECT SUM(amount) AS total FROM payment ";
    $fetchexpenses = mysqli_query($db,$expensessql);
    $expenses = mysqli_fetch_assoc($fetchexpenses);
    $expensestotal = $expenses['total'];
    $accounttotal = $wallettotal - $expensestotal;
    //deleting employee account
    if(isset($_POST['delete'])){
        $eid = $_POST['eid'];
        $deletesql = "DELETE FROM employee WHERE id='{$eid}'";
        $delete = mysqli_query($db,$deletesql);
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
		    <br><br>
		    <h><b>Account Details</b></h>
		    <br><br><br>
		    <p> Account Balance : <?php echo $wallettotal; ?></p>

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
