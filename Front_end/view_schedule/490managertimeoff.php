<?php
  session_start(); 
  if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];
  
    if($_SESSION['manager'] == 0) {
	  header("location:../login/490employeehome.php");
  }
}
else
	{
	header("location:../login/index.php");
	}
?>

<html lang="en">
<head>
<title>Manager Time Off Page</title>
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

<!--scripts for calendars-->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
					<a class="nav-link" href="../login/490managerhome.php">Home<span class="sr-only">(current)</span></a>
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
							<a class="dropdown-item" href="../view_schedule/490managerviewschedule.php">View Schedule</a>
							<a class="dropdown-item" href="../view_schedule/490managertimeoff.php">Request Time Off</a>
							<a class="dropdown-item" href="../view_hours_worked/490managerviewworked.php">View Worked Hours</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../view_worked/490managerworked.php">Edit Worked Hours</a>
							<a class="dropdown-item" href="../alter_schedule/490editschedule.php">Edit Schedule</a>
							
						</div>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="../View_inventory/490managerinventory.php">Inventory</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="../view_employee/490manageremployee.php">Add Employee</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="../login/490managerinstructions.php">Instructions</a>
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
            <h1 class="jumbomessage display-1 text-success font-weight-bold">Request Time Off</h1>
        </div>
    </div>
<!--end top of page-->
	
    <div class="container-fluid">
        <div class="row">

			<div class="col-3"></div>
			<div class="col-6 bg-dark text-light"><!--begin request off area-->
				<form action="request.php" method="POST"><!--begin form for clocking in/out-->
					<label for="request off">Request Day Off:</label><!--use of dialogue boxes-->
					
						<div><!--boxes to input requests-->
						<!--boxes will be read only so that the dates can be selected from a drop-down calendar to improve error checking-->
						Start Date:<input id="startDate" name="startDate" readonly class="form-control"  />
						
						   End Date: <input id="endDate" name="endDate" readonly class="form-control" />
						<br />
						<div align="center">
						<button type="button" name="action" id="action" class="btn btn-warning">Submit</button><!--button to submit days/range-->
						</div>
						<div class="col-3"></div>
						</div><!--end input boxes-->
				</form><!--end request form-->
			</div><!--end request area-->
        </div><!--end of row-->
    </div><!--end of container-->

<script><!--begin script for doing the request off-->
var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#startDate').datepicker({
uiLibrary: 'bootstrap4',
iconsLibrary: 'fontawesome',
minDate: today,
maxDate: function () {
		return $('#endDate').val();
	}
});
$('#endDate').datepicker({
uiLibrary: 'bootstrap4',
iconsLibrary: 'fontawesome',
minDate: function () {
		return $('#startDate').val();
	}
});

$('#action').click(function(){  
           var startDate = $('#startDate').val(); 
           var endDate = $('#endDate').val(); 		    
			//document.write(startDate);
           var action = $('#action').text();  
           if(startDate != '' && endDate != '')  
           {  
				//document.write(action);
                $.ajax({  
                     url : "../request/process.php",  
                     method:"POST",  
                     data:{startDate : startDate, endDate : endDate, action:action},  
                     success:function(data){  
                          alert(data); 
                     }  
                });  
				$('#startDate').val('');
				$('#endDate').val('');
           }  
           else  
           {  
                alert("Both Fields are Required");  
           }  
      });   

</script>
</body>
</html>