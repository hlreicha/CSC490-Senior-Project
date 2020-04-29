<html lang="en">
<head>
<title>Employee Home Page</title>
<meta charset="utf-8">
<!--this allows the webpage to be the length and zoom of device being used-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--other classes for database communication-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!--this is the information taken from getbootstrap.com-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>
/*This is the background for the jumbotron*/
.jumbotron {
    background-image: url("../newcup.jpg");
    background-size: cover;
}

/*Style for WJJC logo*/
.WJJC-logo {
	vertical-align: justify;
}

/*Fixes background for site body*/
body {
	background: url("../coffee-beans-.jpg") no-repeat center center fixed;
}

/*message telling which page it is*/
.jumbomessage {
	text-align: justify;
	 text-shadow: 2px 2px #000000;
}

/*aligns logo and text*/
.box {
	display: flex;
	align-items: center;
}

form label {
	
	font-weight: bold;
	font-size: 20px;
}
</style>

</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container box">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="WJJC-logo">
            <!--at some point, have display appropriate employee id-->
            <h1 class="jumbomessage display-1 text-success font-weight-bold">Log In</h1>
        </div>
    </div>
 
<!--php function to see if inputs are empty-->
<?php 
    if(@$_GET['Empty']==true)
    {
?>
<!--between php to display text-->
    <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>                                
<?php
    }
?>
<?php 
    if(@$_GET['Invalid']==true)
    {
?>
<!--between php to display text-->
    <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Invalid'] ?></div>                                
<?php
    }
?>
 
	<div class="container bg-dark text-light"><!--this is the container for the username and password form-->
        
        <form action="Process.php" method="post"><!--sends inputs to Process.php, in 'login' folder-->
        
			<!--formatting for input box-->
			<div class="form-group row">
			<div class="col-3"></div>
				<div class="col-6">
			
					<!--this box is for the user id-->
					<label for="usr">Employee ID:</label>
					<input type="number" class="form-control input-lg" placeholder="Employee ID" id="usr" name="Employee_ID">
				</div>
			</div>
			
			<!--formatting for input box-->
			<div class="form-group row">
				<div class="col-3"></div>
				<div class="col-6">
				
					<!--this box is for the password-->
					<label for="pwd">Password:</label>
					<input type="password" class="form-control input-lg" placeholder="Password" id="pwd" name="Password">
				</div>
			</div>
			
			<!--button to submit and check if credentials pass-->
			<div align="center">
            <button class="btn btn-success mt-3" name="Login">Login</button>
			</div>
			<br />
        
        </form><!--end form-->
    </div><!--end container for inputs-->

</body>
</html>