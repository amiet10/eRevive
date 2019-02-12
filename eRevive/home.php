<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>eRevive</title>
<?php include('includes/dbconx.php');
	require('includes/errorChk.php');
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	 
//declare variable and assign pathname and associated URL value for each banner
$Img1 = "images/ad1.jpg"; $Url1 = "https://www.marksandspencer.com/";
$Img2 = "images/ad2.jpg"; $Url2 = "https://www.uktights.com/";
$Img3 = "images/ad3.jpg"; $Url3 = "https://www.currys.co.uk/gbuk/index.html/";
	$Img4 = "images/ad4.jpg"; $Url4 = "https://www.motel-one.com/en//";
	$Img5 = "images/ad5.jpg"; $Url5 = "https://www.coca-cola.co.uk/";
	$Img6 = "images/ad6.jpg"; $Url6 = "https://www.fanta.com/";
	

//declare and assign random number range 1 to 3
$num1 = rand (1,3);
	$num2 = rand(4,6);
$Image1 = ${'Img'.$num1};
$URL1 = ${'Url'.$num1};
	$Image2 = ${'Img'.$num2};
$URL2 = ${'Url'.$num2};

?>



<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"><!--allows site to be responsive-->
<meta name="description" content="eRevive - turn your unwanted electrical goods into cash"/><!--description tag for SEO-->
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
			<a href="signup.php" class="waves-effect waves-light btn-large section">Sign up</a>
		</div>
	
		<div class="col s2">
			<a href="login.php" class="waves-effect waves-light btn-large section">Log in</a>
		</div>
	</div>
	<div class="divider"></div>
</header>


<div class="row">
	<aside class="col s3 offset-s1">
	
	<?php
echo "<a href=".$URL1."><img class='responsive-img' src=".$Image1."></a>";
		echo "<a href=".$URL2."><img class='responsive-img' src=".$Image2."></a>";

?>
		<!--<img class="responsive-img" src="images/ad1.jpg">
		<img class="responsive-img" src="images/ad2.jpg">-->
	</aside>



<main class="col s7 centered">
	
	<form action="#" method="get" name="results">
		<div class="input-field col s12 right-align section">
          <input id="productQuery" name="productQuery" type="text" >
          <label for="search">Search</label>
          
          <button class="btn waves-effect waves-light section" type="submit" name="viewAll" id="viewAll">View All</button>
          <button class="btn waves-effect waves-light section" type="submit" name="search" id="search">SearcH<i class="material-icons right">search</i></button>
      	</div>
        
      
	
	<table class="highlight responsive-table col s12">
	
		<th>Title</th>
		<th>Category</th>
		<th>Description</th>
		<th>Image</th>
		<th>Price</th>
	
	
	<?php
		//code to view all products
	
		if(isset($_GET['viewAll'])){	

		if ($stmt = $conn->prepare("SELECT title, category, description, image, price, user FROM products")){
		
		$stmt->bind_result($title, $category, $description, $image, $price, $user);
		
		$stmt->execute();
		
		while ($stmt->fetch()){
			
			/*echo "<tr>
				<td>".$title."</td>
				<td>".$category."</td>
				<td><a href='#modal2' class='waves-effect waves-light btn modal-trigger'>See More</a></td>
				<td><img class='responsive-img' src='images/".$image.".jpg'></td>
				<td>£".$price."</td>
	
				</tr>";*/
			
			echo "<tr>
				<td>".$title."</td>
				<td>".$category."</td>
				<td>".$description."</td>
				<td><img class='responsive-img' src='images/".$image.".jpg'></td>
				<td>£".$price."</td>
	
				</tr>";
			}
		
		$stmt->close();
	}
	else{
		echo "No data returned";
	}
	};
		
		//trying prepared statement
	
		
	if(isset($_GET['search'])){
		
	
	//setting info from form as variables
	$productQuery = "%".$_GET['productQuery']."%";
	if(isset($productQuery) && !empty($productQuery)){
	
$sql = "SELECT * FROM products WHERE (title LIKE ?) OR (category LIKE ?) OR (description LIKE ?)  ORDER BY price";
	$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location:signup.php?error=sqlerror");
		exit();
		}else{
			mysqli_stmt_bind_param($stmt, "sss", $productQuery, $productQuery, $productQuery);
			mysqli_stmt_execute($stmt);
			
			$result = mysqli_stmt_get_result($stmt);
			//takes results from database and stores it back into stmt
			//mysqli_stmt_store_result($stmt);
			//how many results?
			$resultCheck = mysqli_stmt_num_rows($stmt);
				if($row = mysqli_fetch_assoc($result)){
			//if($resultCheck > 0){
				//while($row = mysqli_fetch_assoc($stmt)){
					echo "<tr>
				<td>".$row['title']."</td>
				<td>".$row['category']." </td>
				<td>".$row['description']." </td>
				<td><img class='responsive-img' src='images/".$row['image'].".jpg'></td>
				<td>".$row['price']." </td>
				</tr>";
				}
			
				
			else{
				echo("no results found");
			
			}
			mysqli_stmt_close($stmt);	
	mysqli_close($conn);//closes connection to the database
		}
	 		/*while($row = mysqli_fetch_array($sql)){//and while there are rows in the database pulled through from the query then echo out the below HTML concatonated with the row information//
        		echo "<tr>
				<td>".$row["title"]."</td>
				<td>".$row["category"]." </td>
				<td>".$row["description"]." </td>
				<td><img class='responsive-img' src='images/".$row['image'].".jpg'></td>
				<td>".$row["price"]." </td>
				</tr>";
			}//end of while loop
		}//end of else statement*/
	//mysqli_stmt_close($stmt);	
	//mysqli_close($conn);//closes connection to the database
				
			}
		}
	//}
	

	
	


	
		
	//code for searching for a product
	/*if(isset($_GET['search'])){
	$productQuery = $_GET['productQuery']; //store form 'musicQuery' data//
		//$productQuery = "%{$_GET['productQuery']}%";
		if(isset($productQuery) && !empty($productQuery)){ //check if variable data sent is null or empty - no value has been sent//
		
			//$sql = "SELECT * FROM products WHERE (category LIKE ?) OR (description LIKE ?) OR (title LIKE ?)";
			require('includes/dbconx.php'); //if data is there then connect to the database - instructions for which are found in dbconx.php//
		
			//the next two bits work!!!
			$searchq = mysqli_real_escape_string($conn, $productQuery);//SECURITY FEATURE - remove special characters and clean up string- $searchq stores the clean search data send from the form//
		
			$sql = mysqli_query($conn, "SELECT * FROM products WHERE (title LIKE '%$searchq%') OR (category LIKE '%$searchq%') OR (description LIKE '%$searchq%')  ORDER BY price");//$sql stores a wildcard sql statement//
		
		} //end of if statement
	
	
		else{//if no data was sent then display message to user and provide link back to search page//
		
			echo("<p>Please enter an search term!<p>");
			
		
			die;//die() - SECURITY FEATURE - terminates connection to database
		
		} //end of else statement
	
		
		if(mysqli_num_rows($sql) == 0){ //if no matches are found in database, i.e., the sql statement returns 0, then display message to user, kill the connection and provide link back to search page//
			echo("<p>No matches found. Try another search term.<p>");
			die;
		}//end of if statement
	
		else{//if there are matches, then echo the below HTML//
	
	 		while($row = mysqli_fetch_array($sql)){//and while there are rows in the database pulled through from the query then echo out the below HTML concatonated with the row information//
        		echo "<tr>
				<td>".$row["title"]."</td>
				<td>".$row["category"]." </td>
				<td>".$row["description"]." </td>
				<td><img class='responsive-img' src='images/".$row['image'].".jpg'></td>
				<td>".$row["price"]." </td>
				</tr>";
			}//end of while loop
		}//end of else statement
		
	mysqli_close($conn);//closes connection to the database
	
	}*/
			
	?>
	
	</table>
	
	 
	<!-- 	 <div id="modal2" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p><?php echo $description ?></p>
    </div>
    <div class="modal-footer">
      <a href="#" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>-->
  
	
</main>


	
</div>
	
	
	<footer class="page-footer teal">
          <div class="container teal">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">eRevive.com</h5>
                <p class="grey-text text-lighten-4">Contact us on hello@eRevive.com</p>
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
