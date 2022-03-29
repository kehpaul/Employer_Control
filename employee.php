<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['ADMINNAME'])){
    $admin_id = $_SESSION['ADMINID'];
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        //securing the password, saving the original password in middlename column
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $salary = $_POST['salary'];
        $stmt = mysqli_stmt_init($db);
        if(mysqli_stmt_prepare($stmt, 'INSERT INTO employee(username, password, middlename,salary) VALUES (?,?,?,?)')){
            mysqli_stmt_bind_param($stmt,'sssi',$username,$passwordhash,$password,$salary);
            if(mysqli_stmt_execute($stmt)){
                $message = 'Employee added successfully';
            }
            else{
                $message = 'Error occur while adding employee';
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
					<input type="text" class="login__input" name="username" placeholder=" Employee Username">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" class="login__input" placeholder="Password">
				</div>
				<div class="login__field">
				    <i class="login__icon fas fa-money"></i>
			    	<input type="number" name="salary" class="login__input" placeholder="salary">
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
	<div class="container">
	    <div class="screen">
	        <div class="screen_content">
	            <table>
	                <tr>
	                    <th>ID</th>
	                    <th>Username</th>
	                    <th>Password</th>
	                    <th>action</th>
	                </tr>
	                <?php
	                $employeesql = "SELECT * FROM employee";
	                $fetchemployee = mysqli_query($db,$employeesql);
	                while($employee = mysqli_fetch_assoc($fetchemployee)){
	                    $employee_id = $employee['id'];
	                    echo"
	                    <tr>
	                       <td>{$employee_id}</td>
	                       <td>{$employee['username']}</td>
	                       <td>{$employee['middlename']}</td>
	                       <td>
	                         <form method='post' action=''>
	                         <input type='hidden' name='eid' value='{$employee_id}'>
	                         <button type='submit' name='delete'><i class='fas fa-trash'></i></button>
	                         </form>
	                       </td>
	                       
	                    </tr>";
	                }
	                ?>
	                
	            </table>
	            
	        </div>
	    </div>
	</div>
</div>
<!-- partial -->
  
</body>
</html>
