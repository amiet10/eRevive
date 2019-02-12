<?php 
//session start
session_start();
if(!isset($_SESSION['username'])){
header('location:login.php');

}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>eRevive</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"><!--allows site to be responsive-->
<meta name="description" content="eRevive"/><!--description tag for SEO-->
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!--meta tag to ensure IE compatibility-->

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
</head>

<body>

<header>

	<h1>eRevive</h1>
	<h5>Turn your unwanted electrical goods into cash.</h5>
	
</header>

<div class="container">
<div class="row">
		<div class="col s6 offset-s3">

<?php
	
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require('includes/dbconx.php');
	require('includes/errorChk.php');
	
	$productID = $_GET['id'];
	
	if(isset($productID)){
		
		$stmt = $conn ->prepare("SELECT id, title, category, description, price, user FROM products WHERE id=?");
		
		$stmt->bind_param("s", $productID);
		
		$stmt->bind_result($productID, $title, $category, $description, $price, $username);
		
		$stmt->execute();
		
		$stmt->fetch();
		
		$stmt->close();
	}else{
		echo ("Problem with editing listing.");
	}
	
	?>
	
		
					
					

	
				

				
	

<div class="card">
    			<div class="card-content">
	
	<form action="update-listing.php" method="post">
	<p class="section">Edit a listing...</p>
	
	<input type="hidden" name="id" value="<?php echo $productID; ?>" />
	
	<div class="input-field">
			<label for="title">Title</label>
       		<input name="title" id="title" type="text" value="<?php echo $title; ?>" />
      </div>
	
	<!--<label for="title">Title:</label>
	<input type="text" name="title" value="<?php //echo $title; ?>" />-->
	<div class="input-field">
	<label for="category">Category</label>
	<input type="text" name="category" value="<?php echo $category; ?>" />
		</div>
	
	<div class="input-field">
	<label for="description">Description</label>
	<input type="text" name="description" value="<?php echo $description; ?>" />
		</div>
		
		<div class="input-field">
	<label for="price">Price</label>
	<input type="text" name="price" value="<?php echo $price; ?>" />
	</div>
	
	<div class="input-field">
	<label for="username">Username</label>
	<input type="text" name="username" value="<?php echo $username; ?>" />
		</div>
		
		        					<div class="row">
        					<div class="col s12 right-align">
        						<button class="btn waves-effect waves-light right-align" type="submit" name="edit" id="edit">EDIT<i class="material-icons add">edit</i>
  								</button>
		 					</div>
							</div>
	

		
	</form>
	
	</div>
</div>

		<div class="row center-align">
				<p class="section">Return to <a href="admin-area.php">admin area</a>.</p>
			</div>
		</div>
	</div>
	
</div>

<!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>