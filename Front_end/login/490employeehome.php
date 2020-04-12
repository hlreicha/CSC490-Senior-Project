<!DOCTYPE html>
<html lang="en">
<head>
<title>Employee Home Page</title>
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
            <h1 class="display-2">Welcome "EmpID"</h1>
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
                        <a href="490employeehome.html">Home</a>
                    </li>
                    <li>
                    <!--drops to display account options for employee-->
                    <a href="#empAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Account</a>
                    <ul class="collapse list-unstyled" id="empAccount">
                        <li>
                            <!--link to change password page-->
                            <a href="490employeechangepassword.html">Change Password</a> <!--add link to page-->
                        </li>
                    </ul>
                    </li>
                    <!--drops to display schedule options for employee-->
                    <a href="#empSchedule" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Schedule</a>
                    <ul class="collapse list-unstyled" id="empSchedule">
                        <li>
                            <!--link to schedule page-->
                            <a href="490employeeschedule.html">View Schedule</a><!--add link to page-->
                        </li>
                        <li>
                            <!--link to request time off page-->
                            <a href="490employeetimeoff.html">Request Time Off</a><!--add link to page-->
                        </li>
                    </ul>
                </li>
                <li>
                    <!--link to instruction page for employees-->
                    <a href="490employeeinstructions.html">Instructions</a><!--add link to page-->
                </li>
                <li>
                    <?php
						session_start();

							if(isset($_SESSION['User']))
						{
							echo '<a href="logout.php?logout">Logout</a>';
						}
							else
						{
							header("location:index.php");
						}
					?>
                </li>
            </ul>
        </nav>
    </div>
    </div>
    </div>
    </div>
	





<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>