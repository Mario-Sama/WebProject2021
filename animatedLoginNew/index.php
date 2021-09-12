<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="includes/login.inc.php" method="post">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username/Email</h5>
           		   		<input type="text" class="input" name="uid">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="pwd">
            	   </div>
            	</div>
							<!-- <a href="#">New to our site?Sign Up.</a>  -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">Sign up for free!</button>
            	<button type="submit" class="btn btn-primary" name="submit" data-toggle="modal" data-target="#addadminprofile">Login</button>
							<!--	<input type="submit" class="btn" name="submit" value="Login"> -->
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
		<?php
	  if (isset($_GET["error"])) {
	    if ($_GET["error"] == "emptyinput") {
	      echo "<p>Fill in all fields!</p>";
				alert("Fill in all fields!");
	    }
	    if ($_GET["error"] == "wronglogin") {
	      echo "<p>Incorect login information!</p>";
				alert("Incorect login information!");
	    }
	    if ($_GET["error"] == "none") {
	      echo "<p>You have logged in!</p>";
				alert("You have logged in!");
	    }
	  }
	  ?>
	</section>
</body>
</html>
