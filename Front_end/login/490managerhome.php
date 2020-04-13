<!DOCTYPE html>
<?php
  session_start(); 
  $username = $_SESSION['User']; 
  //echo "The session is ". $_SESSION['manager'];
  if($_SESSION['manager'] == 0) {
	  header("location:490employeehome.php");
  }
  
?>
<html lang="en">
<head>
<title>Manager Home Page</title>
<meta charset="utf-8">
<!--this allows the webpage to be the length and zoom of device being used-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--this is the information taken from getbootstrap.com-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <!--adds the logo to the page-->
            <img src="WJJC-logo.png" class="float-right">
            <!--at some point, have display appropriate employee id-->
            <h1 class="display-2">Welcome "ManID"</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

                <!--builds structure for sidebar menu-->
            <div class="col-2">
                <!--builds structure for sidebar menu-->
                 <div class="wrapper">
                    <!--defines set of navigation links-->
                    <nav id="sidebar">
                        <div class="sidebar-header">
                        <h3>Employee Menu</h3>
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
                                <a href="../view_schedule/490viewschedule.php">View Schedule</a><!--add link to page-->
                            </li>
                            <li>
                                <!--link to request time off page-->
                                <a href="#">Request Time Off</a><!--add link to page-->
                            </li>
														<li>
                            <!--link to worked page for managers-->
                            <a href="../view_worked/490managerworked.php">View Hours Worked</a><!--add link to page-->
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
            </div>

            <!--This is where form starts-->
        </div>
    </div>





<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>