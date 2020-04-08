<!DOCTYPE html>
<html lang="en">
<head>
<title>Employee Change Password</title>
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
             <img src="WJJC-logo.png" class="float-right">
            <!--at some point, have display appropriate employee id-->
            <h1 class="display-2">Account Info for "EmpID"</h1>
        </div>
    </div>

    <!--main container-->
    <div class="container-fluid">
        <div class="row">

            <!--start of column for side menu-->
            <!--will always take up 2 spaces to leave padding for main content-->
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
                                <li>
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
                                    <a href="490login.html">Log Out</a><!--log out link-->
                                </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!--main form on page for changing password-->
            <!--takes up 6 spaces-->
            <div class="col-6">
                <!--arbitrary action page, add later-->
                <form action="/action_page.php">
                    <!--create form for password-->
                    <div class="form-group">
                        <!--space for inputting current password-->
                        <label for="pwd">Enter current password:</label>
                            <input type="password" class="form-control" placeholder="Enter current password" id="pwd">
                    </div>
                    <!--create form for new password-->
                    <div class="form-group">
                        <!--space for inputting new password-->
                        <label for="npwd">Enter new password:</label>
                            <input type="password" class="form-control" placeholder="Enter new password" id="npwd">
                    </div>
                    <!--submit change-->
                    <button class="btn btn-primary">Submit</button>
                </form> 
            </div>
        </div>
    </div>
</body>
</html>