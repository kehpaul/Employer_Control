<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbuser,$dbpassword,$dbdatabase);
if(isset($_SESSION['ADMINNAME'])){
    $admin_id = $_SESSION['ADMINID'];
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        
        $employeeid = $_POST['employeeid'];
        $stmt = mysqli_stmt_init($db);
        if(mysqli_stmt_prepare($stmt, 'INSERT INTO task(name, description,user_id) VALUES (?,?,?)')){
            mysqli_stmt_bind_param($stmt,'ssi',$name,$description,$employeeid);
            if(mysqli_stmt_execute($stmt)){
                $message = 'Task added successfully';
            }
            else{
                $message = 'Error occur while adding task';
            }
            
        }
    }
    //deleting task
    if(isset($_POST['delete'])){
        $tid = $_POST['tid'];
        $deletesql = "DELETE FROM task WHERE id='{$tid}'";
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
			<form class="login up" action='' method='post'>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" name="name" placeholder=" Task Name">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-pencil"></i>
					<textarea  name="description" class="login__input" placeholder="Descriptions"></textarea>
				</div>
				
				<div class="login__field">
			    	<select name="employeeid">
			    	     <?php 
			    	     $employeesql = "SELECT * FROM employee";
			    	     $fetchemployee = mysqli_query($db,$employeesql);
			    	     while($employee= mysqli_fetch_assoc($fetchemployee)){
			    	         echo "
			    	         <option value='{$employee['id']}'>{$employee['username']}</option>
			    	         ";
			    	     }
			    	     ?>
			    	 
			    	</select>
				</div>
				<button class="button login__submit" name="submit">
					<span class="button__text">Add task</span>
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
	
	    <div class="screen">
	        <div class="screen_content">
	            <table>
	                <tr>
	                    <th>ID</th>
	                    <th>Name</th>
	                    <th>Employee ID</th>
	                    <th>Status</th>
	                    <th>action</th>
	                </tr>
	                <?php
	                $tasksql = "SELECT * FROM task";
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
	                       <td>{$task['user_id']}</td>
	                       <td>{$status}</td>
	                       <td>
	                         <form method='post' action=''>
	                         <input type='hidden' name='tid' value='{$task_id}'>
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
