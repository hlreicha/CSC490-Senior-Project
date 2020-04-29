<?php
  session_start(); 
  if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];
  
    if($_SESSION['manager'] == 1) {
	  header("location:../login/490managerhome.php");
  }
    else if($_SESSION['pw'] == 1){
	header("location:../change_password/change_password.php");	
				}
}
else
	{
	header("location:../login/index.php");
	}
?>

<html lang="en">
<head>
<title>Employee View Schedule Page</title>
<meta charset="utf-8">
<!--this allows the webpage to be the length and zoom of device being used-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--links-->
<!--this is for navbar menu at top of page-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!--this is the information taken from getbootstrap.com-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>
/*This is the background for the jumbotron*/
.jumbotron {
    background-image: url("../newcup.jpg");
    background-size: cover;
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
</style>
</head>

<body>
<!--start top of page-->
	<!--start of top navbar menu-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
	
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto topnav">
				<li class="nav-item active">
					<a class="nav-link" href="../login/490employeehome.php">Home<span class="sr-only">(current)</span></a>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Account
					</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../change_password/change_password.php">Change Password</a>
						</div>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Schedule
					</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../view_schedule/490employeeviewschedule.php">View Schedule</a>
							<a class="dropdown-item" href="../view_schedule/490employeetimeoff.php">Request Time Off</a>
							<a class="dropdown-item" href="../view_hours_worked/490employeeviewworked.php">View Hours Worked</a>
						</div>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="../login/490employeeinstructions.php">Instructions</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link" href="../login/logout.php?logout">Log Out</a>
				</li>
			</ul>
		</div>
	</nav><!--end navbar-->

    <div class="jumbotron jumbotron-fluid">
        <div class="container box">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="WJJC-logo">
            <!--at some point, have display appropriate employee id-->
            <h1 class="jumbomessage display-1 text-success font-weight-bold">View Schedule</h1>
        </div>
    </div>
<!--end top of page-->

    <div class="container-fluid">
        <div class="row">
		
			<div class="col-12"><!--start of table-->
				<?php      
					include ("view_sched.php");
					
					echo '<table class="table table-dark table-striped">
							
							</table>'
				?>
			</div><!--end of table-->
			
        </div><!--end of row-->
    </div><!--end of container-->
	
<!--scripts-->
<!--other classes for database communication-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--this is for the navbar menu at top of page-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>

</body>
</html>