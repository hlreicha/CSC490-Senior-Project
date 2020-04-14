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
<title>Manager Home Page</title>
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

</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="float-right">
            <!--at some point, have display appropriate employee id-->
            <h1 class="display-2">Welcome "EmpID"</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-2"><!--start of side menu-->
                <!--builds structure for sidebar menu-->
                 <div class="wrapper">
                    <!--defines set of navigation links-->
                    <nav id="sidebar">
                        <div class="sidebar-header">
                        <h3>Manager Menu</h3>
                        </div>
                    <ul class="list-unstyled components">
                        <li class="active">
                        <li>
                            <!--link to home page-->
                            <a href="490managerhome.php">Home</a>
                        </li>
                        <li>
                            <!--drops to display account options for employee-->
                            <a href="#manAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Account</a>
                            <ul class="collapse list-unstyled" id="manAccount">
                                <li>
                                <!--link to change password page-->
                                <a href="#">Change Password</a> <!--add link to page-->
                                </li>
                            </ul>
                        </li>
                        <!--drops to display schedule options for employee-->
                        <a href="#manSchedule" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Schedule</a>
                        <ul class="collapse list-unstyled" id="manSchedule">
                            <li>
                                <!--link to schedule page-->
                                <a href="../view_schedule/490managerviewschedule.php">View Schedule</a><!--add link to page-->
                            </li>
                            <li>
                                <!--link to request time off page-->
                                <a href="../view_schedule/490managertimeoff.php">Request Time Off</a><!--add link to page-->
                            </li>
														<li>
                            <!--link to worked page for managers-->
                            <a href="../view_worked/490managerworked.php">View Hours Worked</a><!--add link to page-->
                            </li>
							<li>
                            <!--link to worked page for managers-->
                            <a href="../alter_schedule/490editschedule.php">Edit Schedule</a><!--add link to page-->
                            </li>
                            <li>
                                <!--link to create schedule-->
                                <a href="#">Create Schedule</a><!--add link to page-->
                            </li>
                        </ul>
                        <li>
                            <!--link to inventory page for managers-->
                            <a href="../View_inventory/490managerinventory.php">Check Inventory</a><!--add link to page-->
                        </li>
                        </li>
                        <li>
                            <!--link to instruction page for managers-->
                            <a href="490managerinstructions.php">Instructions</a><!--add link to page-->
                        </li>
                        <li>
                            <a href="logout.php?logout">Log Out</a><!--log out link-->
                        </li>
                        </li>
                    </ul>
                    </nav>
                </div>
            </div><!--end of side menu-->
			
			<div class="col-8"><!--start of clock in area-->
			<?php
			/*
			include functions from record_time.php
			this also provides the button for clocking in/out within the record_time.php file
			*/
			include ("record_time.php");
			?>
			</div><!--end of clock in area-->

        </div><!--end of row-->
    </div><!--end of container-->

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>