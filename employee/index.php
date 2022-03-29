
		<?php
session_start();
if(isset($_SESSION['EMPLOYEE'])){
    header('location:home.php');
}
else{
    header('location:login.php');
}
?>		

  

