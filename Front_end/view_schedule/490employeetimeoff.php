<?php
  session_start(); 
  if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];
  
    if($_SESSION['manager'] == 1) {
	  header("location:../login/490manager.php");
  }
}
else
	{
	header("location:../login/index.php");
	}
?>

<html lang="en">
<head>
<title>Employee Time Off Page</title>
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
.jumbotron {
    background-image: url("../cupbackground.jpg");
    background-size: cover;
}
</style>

</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="float-left">
            <!--at some point, have display appropriate employee id-->
            <h1 class="display-1 text-success font-weight-bold">Time Off</h1>
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
                        <h3>Employee Menu</h3>
                        </div>
                    <ul class="list-unstyled components">
                        <li class="active">
                        <li>
                            <!--link to home page-->
                            <a href="../login/490employeehome.php">Home</a>
                        </li>
                        <li>
                            <!--drops to display account options for employee-->
                            <a href="#empAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Account</a>
                            <ul class="collapse list-unstyled" id="empAccount">
                                <li>
                                <!--link to change password page-->
                                <a href="#">Change Password</a> <!--add link to page-->
                                </li>
                            </ul>
                        </li>
                        <!--drops to display schedule options for employee-->
                        <a href="#empSchedule" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Schedule</a>
                        <ul class="collapse list-unstyled" id="empSchedule">
                            <li>
                                <!--link to schedule page-->
                                <a href="../view_schedule/490employeeviewschedule.php">View Schedule</a><!--add link to page-->
                            </li>
                            <li>
                                <!--link to request time off page-->
                                <a href="../view_schedule/490employeetimeoff.php">Request Time Off</a><!--add link to page-->
                            </li> 
                        </ul>
                        </li>
                        <li>
                            <!--link to instruction page for managers-->
                            <a href="#">Instructions</a><!--add link to page-->
                        </li>
                        <li>
                            <a href="../login/logout.php?logout">Log Out</a><!--log out link-->
                        </li>
                        </li>
                    </ul>
                    </nav>
                </div>
            </div><!--end of side menu-->
			
			<div class="col-6"><!--begin request off area-->
				<form action="request.php" method="POST"><!--begin form for clocking in/out-->
					<label for="request off">Request Day Off:</label><!--use of dialogue boxes-->
					
						<div><!--boxes to input requests-->
						<!--boxes will be read only so that the dates can be selected from a drop-down calendar to improve error checking-->
						Start Date: <input id="startDate" name="startDate" class="form-control" readonly />
						
						End Date: <input id="endDate" name="endDate" class="form-control" readonly />
						
						<button type="button" name="action" id="action" class="btn btn-warning">Submit</button><!--button to submit days/range-->
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