<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['ADMINNAME'])){
    $admin_id = $_SESSION['ADMINID'];
    if(isset($_POST['pay'])){
        $employeeid = $_POST['eid'];
        $salary = $_POST['salary'];
        $description ='payment of salary for '.$_POST['employee'];
        
        
        $stmt = mysqli_stmt_init($db);
        if(mysqli_stmt_prepare($stmt, 'INSERT INTO wallet(amount,employee_id) VALUES (?,?)')){
            mysqli_stmt_bind_param($stmt,'ii',$salary,$employeeid);
            if(mysqli_stmt_execute($stmt)){
                $message = ' Payment made successfully';
                $insertpayment = " INSERT INTO payment(description,amount) VALUES ('$description','$salary')";
                $payment = mysqli_query($db,$insertpayment);
            }
            else{
                $message = 'Error occur while adding task';
            }
            
        }
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
	    <table>
	                <tr>
	                    <th>ID</th>
	                    <th>Firstame</th>
	                    <th>Lastname</th>
	                    <th>Username</th>
	                    <th>Salary</th>
	                    <th>Action</th>
	                </tr>
	                <?php
	                $tasksql = "SELECT * FROM employee";
	                $fetchtask = mysqli_query($db,$tasksql);
	                while($task = mysqli_fetch_assoc($fetchtask)){
	                    $task_id = $task['id'];
	                    echo"
	                    <tr>
	                       <td>{$task_id}</td>
	                       <td>{$task['firstname']}</td>
	                       <td>{$task['lastname']}</td>
	                       <td>{$task['username']}</td>
	                       <td>{$task['salary']}</td>
	                       <td>
	                         <form method='post' action=''>
	                         <input type='hidden' name='eid' value='{$task_id}'>
	                         <input type='hidden' name='salary' value='{$task['salary']}'>
	                         <input type='hidden' name='employee' value='{$task['username']}'>
	                         <button type='submit' name='pay'><i class=fas fa-money'></i>Pay</button>
	                         </form>
	                       </td>
	                       
	                    </tr>";
	                }
	                ?>
	                
	            </table>
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
