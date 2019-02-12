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
<?php include('includes/dbconx.php');
	require('includes/errorChk.php');
	?>

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

if(isset($_POST['add'])){
	if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['username'])){
		
		$title = $_POST['title'];
		
		$category = $_POST['category'];
		
		$description = $_POST['description'];
		
		$price = $_POST['price'];
		
		$username = $_POST['username'];
		
		
		$sql = "INSERT INTO products (title, category, description, price, user) VALUES (?,?,?,?,?)";
		
		//prepare the sQL statement for execution
		
		$stmt = $conn->prepare($sql);
		
		//binds variables to the prepared statement as paramaters
		$stmt->bind_param("sssis", $title, $category, $description, $price, $username);
		
		//executes the prepared query
		
		$stmt->execute();
		//redirect user to a confirmation page
		echo('
		<div class="card teal lighten-3 center-align">
    			<div class="card-content">New listing succesfully created!  
				<br>
				<br>
				Return to <a href="admin-area.php">admin area.</a>
				</div>
				
				</div>');
		//close the connection when done

$conn->close();
		
	}else{
		die('New listing not created! Return to <a href="admin-area.php">admin area</a>.'); //kill the database connection
	}
}
	?>

	
			<div class="card">
    			<div class="card-content">
					
					<form action="#" method="post" name="new-listing"><!--get will show in URL, post doesn't show!-->
						<p class="section">Add a new listing...</p>

							<div class="input-field">
							  <input id="title" name="title" id="title" type="text" class="validate">
							  <label for="title">Title</label>
        					</div>
	
        					<div class="input-field">
							  <input id="category" name="category" id="category" type="text" class="validate">
							  <label for="category">Category</label>
      						</div>
      						
      	
      						<div class="input-field">
          						<textarea id="description" name="description" id="description" class="materialize-textarea"></textarea>
         						<label for="description">Description</label>
							</div>
        					
         					<div class="input-field">
							  <input id="price" name="price" id="price" type="text" class="validate">
							  <label for="price">Price</label>
     						</div>
     						
     						<div class="file-field input-field">
								<div class="btn">
								<span>Image</span>
								<input type="file">
									</div>
									<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
									</div>
    						</div>
     						
     						<div class="input-field">
							  <input id="username" name="username" type="text" class="validate">
							  <label for="username">Username</label>
     						</div>
        
        					<div class="row">
        					<div class="col s12 right-align">
        						<button class="btn waves-effect waves-light right-align" type="submit" name="add" id="add">ADD<i class="material-icons add">add</i>
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