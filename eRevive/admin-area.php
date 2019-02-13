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
<meta name="description" content="IC Moves - Ayrshire's Premiere Letting & Estate Agency"/><!--description tag for SEO-->
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
	<div class="row valign-wrapper">
		<div class="col s7">
			<h1>eRevive</h1>
			<h5>Turn your unwanted electrical goods into cash.</h5>
		</div>
	
		<div class="col s2 right-align">
			<h6>Logged in as: <?php echo $_SESSION['username']?></h6>
		</div>
	
		<div class="col s2">
			<a href="logout.php" class="waves-effect waves-light btn-large section">Log Out</a>
		</div>
	</div>
	<div class="divider"></div>
</header>


<div class="row">
	


<div class="card col s4 offset-s4">
    			<div class="card-content">
				  <p class="section">Hi <?php echo $_SESSION['username']?>!</p>
				  <p class="section">Welcome to the admin area of eRevive.  From here you can upload, edit and delete listings.</p>
				  <p class="section">Happy selling!</p>
				  
    			</div>
    		</div>
<main class="col s10 offset-s1 center-align">
<br>
       <br>
        <a href="create-listing.php" class="waves-effect waves-light btn-large section">Add new listing</a>
        <br>
        <br>
      
	
	<table class="highlight responsive-table col s12">
	
		<th>Title</th>
		<th>Category</th>
		<th>Description</th>
		<th>Price</th>
		<th></th>
		<th></th>
		<th></th>
	
	
	<?php
		//code to view all products
	
		if($stmt = $conn->prepare("SELECT id, title, category, description, image, price FROM products")){
		
		$stmt->bind_result($id, $title, $category, $description, $image, $price);
		
		$stmt->execute();
		
		while ($stmt->fetch()){
			
			echo "<tr>
				<td>".$title."</td>
				<td>".$category."</td>
				<td>".$description."</td>
				<td>£".$price."</td>
				<td><img class='responsive-img' src='images/".$image.".jpg'></td>
				<td><a href='update.php?id=".$id."'class='waves-effect waves-light btn'>Update</a></td>
				<td><a href='#modal1' class='waves-effect waves-light btn modal-trigger red darken-4'>Delete</a></td>
	            </tr>";
			
			
			}
	
		$stmt->close();
	}
	else{
		echo "No data returned";
	}
			
	?>
	
	</table>
	
	 
  
	
</main>

<div id="modal1" class="modal">
    <div class="modal-content">
      <p>Are you sure you want to delete this record?</p>
    </div>
    <div class="modal-footer">
     <a href="#" class="modal-close waves-effect btn-flat">Cancel</a>
      <a href="delete-listing.php?id=<?php echo $id ?>" class="modal-close waves-effect red btn-flat"><i class="material-icons add">delete_forever</i></a>
    </div>
  </div>
  
	
</div>
	
	
	<footer class="page-footer teal">
          <div class="container teal">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">eRevive.com</h5>
                <p class="grey-text text-lighten-4">Contact us on hell@eRevive.com</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Get social</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="http://www.facebook.com">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="http://www.instagram.com">Insta</a></li>
                  <li><a class="grey-text text-lighten-3" href="http://www.twitter.com">Twitter</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright teal-darken1">
            <div class="container">
            © 2019 Copyright
            <a class="grey-text text-lighten-4 right" href="http://www.amiethomson.com">amiethomson.com</a>
            </div>
          </div>
        </footer>
	
	<!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="script.js"></script>
</body>
</html>