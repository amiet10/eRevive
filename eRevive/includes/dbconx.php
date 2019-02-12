<?php

$conn = new mysqli("localhost","root", "root", "eRevive");
// Check connection

if ($conn->connect_error) {
	echo("<a href='create.php'>return to create page</a>");
    die("Connection failed: " . $conn->connect_error);
	
	
	
} 

?>