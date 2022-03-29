<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['EMPLOYEE'])){
    $employee_id = $_SESSION['EMPLOYEEID'];
    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email  = $_POST['email'];
        $tel = $_POST['tel'];
        //securing the password, saving the original password in middlename column
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $salary = $_POST['salary'];
        $stmt = mysqli_stmt_init($db);
        if(mysqli_stmt_prepare($stmt, 'UPDATE employee SET firstname=?,lastname=?,email=?,telephone=? WHERE id=?')){
            mysqli_stmt_bind_param($stmt,'ssssi',$firstname,$lastname,$email,$tel,$employee_id);
            if(mysqli_stmt_execute($stmt)){
                $message = ' Details updated successfully';
            }
            else{
                $message = 'Error occur while updating your details';
            }
            
        }
    }
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
		    <p class='error'><?php echo $message; ?></p>
			<form class="login up" action='' method='post'>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" name="firstname" placeholder=" firstname">
				</div>
								<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" name="lastname" placeholder=" lastname">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-envelope"></i>
					<input type="email" name="email" class="login__input" placeholder="email">
				</div>
				<div class="login__field">
				    <i class="login__icon fas fa-mobile"></i>
			    	<input type="number" name="tel" class="login__input" placeholder="telephone">
				</div>
				<button class="button login__submit" name="submit">
					<span class="button__text">Submit</span>
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
	<div class="container">
	    <div class="screen">
	        <div class="screen_content">
	         
	                <?php
	                $employeesql = "SELECT * FROM employee WHERE id='{$employee_id}'";
	                $fetchemployee = mysqli_query($db,$employeesql);
	                $employee = mysqli_fetch_assoc($fetchemployee);
	                    $employee_id = $employee['id'];
	                    echo"
	                    <ul>
	                       <li>Firstname:{$employee['firstname']}</li>
	                       <li>Lastname:{$employee['lastname']}</li>
	                       <li>Email:{$employee['email']}</li>
	                       <li>Telephone:{$employee['telephone']}</li>";
	                ?>
	                
	            
	            
	        </div>
	    </div>
	</div>
</div>
<!-- partial -->
  
</body>
</html>
