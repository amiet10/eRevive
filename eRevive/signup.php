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

	<h1>eRevive</h1>
	<h5>Turn your unwanted electrical goods into cash.</h5>
	
</header>

<div class="container">

	<div class="row">
		<div class="col s6 offset-s3">
			<div class="card">
    			<div class="card-content">
					
					<form action="data-collect-sign-up.php" method="post" name="data-collect-sign-up"><!--get will show in URL, post doesn't show!-->
						<p class="section">Create your eRevive account...</p>
<?php
						if (isset($_GET['error'])){
							if($_GET['error'] == "emptyfields"){
								echo '<h4 class="red-text">Fill in all fields!</h4>';
						
								
							}
							else if ($_GET['error'] == "invalidemailusername"){
								echo '<h4 class="red-text">Invalid email and username!</h4>';
							}
							elseif ($_GET['error'] == "invalidusername"){
								echo '<h4 class="red-text">Invalid username!</h4>';
							}
							elseif ($_GET['error'] == "invalidusername"){
								echo '<h4 class="red-text">Invalid username!</h4>';
							}
							elseif ($_GET['error'] == "passwordcheck"){
								echo '<h4 class="red-text">passwords do not match!</h4>';
							
						}
								elseif ($_GET['error'] == "usernametaken"){
								echo '<h4 class="red-text">Username already taken!</h4>';
							
						}
						
						}
						?>
							<div class="input-field">
							  <input id="username" name="username" type="text" class="validate">
							  <label for="username">Username</label>
        					</div>
	
       					<div class="input-field">
							  <input id="email" name="email" type="email" class="validate">
							  <label for="email">Email address</label>
     						</div>
        					<div class="input-field">
							  <input id="password" name="password" type="password" class="validate">
							  <label for="password">Password</label>
      						</div>
      						
      						<div class="input-field">
							  <input id="password" name="password-repeat" type="password" class="validate">
							  <label for="password">Repeat Password</label>
      						</div>
       
         					
        
        					<div class="row">
        					<div class="col s12 right-align">
        						<button class="btn waves-effect waves-light right-align" type="submit" name="signUp" id="signUp">Sign up
  								</button>
		 					</div>
							</div>
					</form>
				</div>
				</div>
				
				


			<div class="row center-align">
				<p class="section">return to <a href="home.php">home</a>.</p>
			</div>
		</div>
	</div>
	
</div>
	
	


<!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>