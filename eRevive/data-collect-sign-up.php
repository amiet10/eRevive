<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require('includes/dbconx.php');

if(isset($_POST['signUp'])){
	
	
	//setting info from form as variables
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordRepeat = $_POST['password-repeat'];
	
	//checking to see if any fields have been left empty and if so sending an error message sending any filled in fields
	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
		header("location:signup.php?error=emptyfields");
		exit(); //if user makes a mistake, will stop script from running
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
		header("location:signup.php?error=invalidemailusername");
			exit();
		
	}
	//checking that a valid email address has been put in using a PHP function
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("location:signup.php?error=invalidmail");
		exit();
	}
	//checkign the pattern of the username matches
	elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		header("location:signup.php?error=invalidusername");
		exit();
	}
	
	//checking that both passwords match
	elseif ($password !== $passwordRepeat){
		header("location:signup.php?error=passwordcheck");
		exit();
	}
	
	//checkig that the username doesn't already exist in the database
	else{
		//create SQL prepared statement
		$sql = "SELECT username FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		//checking that the statement will work, if not error message
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location:signup.php?error=sqlerror");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			//takes results from database and stores it back into stmt
			mysqli_stmt_store_result($stmt);
			//how many results?
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck >0){
				header("location:signup.php?error=usernametaken");
		exit();		
			}
			else{
				$sql = "INSERT INTO users (username, password, email) VALUES (?,?,?)";
				$stmt = mysqli_stmt_init($conn);
		//checking that the statement will work, if not error message
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location:signup.php?error=sqlerror");
		exit();
		}
		else{
			//creating a variable which is the hashed password
			$hash = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $email);
			mysqli_stmt_execute($stmt);
			header("location: successful-signup.php");
		exit();
				
			}
		}
	}
	
}
	
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}

//code will only work if user clicked on the sign up subnmit button
else{
	header("location: signup.php");
	exit();
}
/*if(isset($_POST['signUp'])){
	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])){
		
		$username = $_POST['username'];
		
		$password = $_POST['password'];
		
		$hash = password_hash($password, PASSWORD_DEFAULT);
		
		$email = $_POST['email'];
		
		$sql = "INSERT INTO users (username, password, email) VALUES (?,?,?)";
		
		//prepare the sQL statement for execution
		
		$stmt = $conn->prepare($sql);
		
		//binds variables to the prepared statement as paramaters
		$stmt->bind_param("sss", $username, $hash, $email);
		
		//executes the prepared query
		
		$stmt->execute();
		//redirect user to a confirmation page
		header("location: successful-signup.php");
		//close the connection when done

$conn->close();
		
	}
	else{
		//email form field contains no value
		
		die('No username included!'); //kill the database connection
	}
	
	
}*/

?>