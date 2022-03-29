<?php
session_start();
require ("configure.php");
$db = new mysqli($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['EMPLOYEE'])){
    $employee_id = $_SESSION['EMPLOYEEID'];
  
    //deleting task
    if(isset($_POST['done'])){
        $tid = $_POST['tid'];
        $deletesql = "UPDATE task SET done='1' WHERE id='{$tid}'";
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
		    <span class='error'><?php echo $message; ?></span>
		 <table>
	                <tr>
	                    <th>ID</th>
	                    <th>Name</th>
	                    <th>Description</th>
	                    <th>Status</th>
	                    <th>action</th>
	                </tr>
	                <?php
	                $tasksql = "SELECT * FROM task WHERE user_id= '{$employee_id}'";
	                $fetchtask = mysqli_query($db,$tasksql);
	                while($task = mysqli_fetch_assoc($fetchtask)){
	                    $task_id = $task['id'];
	                    $done = $task['done'];
	                    if($done == '0'){
	                        $status = 'not completed';
	                    }
	                    elseif($done == '1'){
	                        $status = 'completed';
	                    }
	                    echo"
	                    <tr>
	                       <td>{$task_id}</td>
	                       <td>{$task['name']}</td>
	                       <td>{$task['description']}</td>
	                       <td>{$status}</td>
	                       <td>
	                         <form method='post' action=''>
	                         <input type='hidden' name='tid' value='{$task_id}'>
	                         <button type='submit' name='done'><i class='fas fa-check-square'></i></button>
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
