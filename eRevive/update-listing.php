<?php
//session start
session_start();
if(!isset($_SESSION['username'])){
header('location:login.php');

}


require('includes/dbconx.php');
require('includes/errorChk.php');

if(isset($_POST['id'])){
	$productID = $_POST['id'];
	
	//echo $recordID;
	
	$title =$_POST['title'];
	$category=$_POST['category'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$username = $_POST['username'];
	
	
	$stmt = $conn->prepare("UPDATE products SET title=?, category=?, description=?, price=?, user=? WHERE id=?");
	
	$stmt->bind_param("sssssi", $title, $category, $description, $price, $username, $productID);
	$stmt->execute();
	$stmt->close();
	$conn->close(); //close connection
	header('Location: admin-area.php');
}
?>


