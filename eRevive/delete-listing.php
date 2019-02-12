<?php
//session start
session_start();
if(!isset($_SESSION['username'])){
header('location:login.php');

}

	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
	if(isset($_GET['id'])){
		include('includes/dbconx.php');
		
		$productID = $_GET['id'];
		
		//echo $myID;
		
		//echo "The data type is " .gettype($myID);
		
		$sql = "DELETE FROM products WHERE id = ?";
		
		$stmt = $conn->prepare($sql); //prepare the SQL statement for execution
		
		$stmt->bind_param("s", $productID); //bings variables to the prepared statement
		
		$stmt->execute(); //executes the prepared query
		
		header("location: admin-area.php");
		
	
	}
	
	else{
		echo "Error deleting record: " . $conn->error;
	}
	?>
