<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('includes/dbconx.php');
include('includes/errorChk.php');

if (isset($_POST['login'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username) || empty($password)){
		header('location:login.php?error=emptyfields');
		exit();
		
	}
	else{
		
		//setting up prepared statement to check that username and password matches what is in the database
		$sql = "SELECT * FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		//checking that the statment will actually work before it's run
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header('location:login.php?error=sqlerror');
		exit();
		}
		else{
			//pass in paramaters from user input
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			
			//put results into a variable
			$result = mysqli_stmt_get_result($stmt);
			//is there any results from the database, if so put into an assocaitive array so that am able to work with it
			if($row = mysqli_fetch_assoc($result)){
				//create new variable which is checking password from user input against hashed password in database
				$passwordCheck = password_verify($password, $row['password']);
				if($passwordCheck == false){
					header('location:login.php?error=wrongpassword');
					exit();
				}
				else if($passwordCheck == true){
					session_start();
					$_SESSION['username'] = $row['username'];
					
					header('location:admin-area.php');
				exit();	
				} else{
				header('location:login.php?error=wrongpassword');
				exit();	
				}
			}
			else{
				header('location:login.php?error=nouser');
				exit();
			}
		}
	}
	
}
else{
header('location:login.php');
	exit();
}



/*if(isset($_POST['login'])){

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
		
$sql = "SELECT username, password FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); // output data of each row

if ($result->num_rows == 1 && $username==$row['username'] && password_verify($password, $row['password']) ) {
  $_SESSION['username']=$username;
			

header('location:admin-area.php');
}

 else {
    header('location:unsuccessful-login.php');

}

} // end of isset
$conn->close();
 */

?>