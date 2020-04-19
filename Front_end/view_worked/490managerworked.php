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
<title>View Worked Page</title>
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
.jumbotron {
    background-image: url("../cupbackground.jpg");
    background-size: cover;
}

body {
	background-image: url("../coffee-beans-.jpg");
}
</style>

</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="float-left">
            <!--at some point, have display appropriate employee id-->
            <h1 class="display-1 text-success font-weight-bold">View Worked</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-2"><!--start of side menu-->
                <!--builds structure for sidebar menu-->
                 <div class="wrapper border border-dark">
                    <!--defines set of navigation links-->
                    <nav id="sidebar">
                        <div class="sidebar-header">
                        <h3>Manager Menu</h3>
                        </div>
                    <ul class="list-unstyled components">
                        <li class="active">
                        <li>
                            <!--link to home page-->
                            <a href="../login/490managerhome.php">Home</a>
                        </li>
                        <li>
                            <!--drops to display account options for manager-->
                            <a href="#manAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Account</a>
                            <ul class="collapse list-unstyled" id="manAccount">
                                <li>
                                <!--link to change password page-->
                                <a href="../view_employee/490manageremployee.php">Edit Employee</a> <!--add link to page-->
                                </li>
								<li>
                                <!--link to change password page-->
                                <a href="#">Change Password</a> <!--add link to page-->
                                </li>
                            </ul>
                        </li>
                        <!--drops to display schedule options for manager-->
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
                                <!--link to create schedule-->
                                <a href="../alter_schedule/490editschedule.php">Edit Schedule</a><!--add link to page-->
                            </li>
                        </ul>
                        <li>
                            <!--link to inventory page for managers-->
                            <a href="../View_inventory/490managerinventory.php">Check Inventory</a><!--add link to page-->
                        </li>
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

            <!--This is where form starts-->
			<div class="container">  
		   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:white">
                <h3 align="center">Worked Schedule</h3>  
                <br /><br />  
                <br /><br />
                <label>Worked ID</label>  
                <input type="text" name="WorkedID" id="WorkedID" readonly class="form-control" />  
                <br /> 				
                <label>Employee ID</label>  
                <input type="text" name="Employee_ID" id="Employee_ID"  class="form-control" />  
                <br /> 				
                <label>Schedule ID</label>  
                <input type="text" name="SchedID" id="SchedID" readonly class="form-control" />  
                <br />  
                <label>Recorded Start</label>  
                <input type="datetime-local" name="Recorded_Start" id="Recorded_Start" class="form-control"  />  
                <br /><br />
                <label>Recorded End</label>  
                <input type="datetime-local" name="Recorded_End" id="Recorded_End" class="form-control" />  
                <br /><br /> 				
                <div align="center">  
                     <input type="hidden" name="id" id= "WorkedID1" />  
                     <button type="button" name="action" id="action" class="btn btn-warning">Add</button>  
                </div>  
                <br />  
                <br />  
                <div id="result" class="table-responsive">  
                </div> 
              </div>
</div>				
           </div> 








	
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      fetchUser();  
      function fetchUser()  
      {  
           var action = "select";  
           $.ajax({  
                url : "select.php",  
                method:"POST",  
                data:{action:action},  
                success:function(data){ 
					 $('#WorkedID').val(''); 
                     $('#Employee_ID').val('');  
                     $('#SchedID').val(''); 
					 $('#Recorded_Start').val('');
					 $('#Recorded_End').val(''); 
                     $('#Hours Worked').val('');  
                     $('#isLate').val(''); 
					 $('#isSched').val('');
					 $('#leftEarly').val('');					 
                     $('#action').text("Add");  
                     $('#result').html(data); 
					//alert(data);
                }  
           });  
      }  
      $('#action').click(function(){  
		   var Employee_ID = $('#Employee_ID').val();
           var SchedID = $('#SchedID').val();  
           var Recorded_Start = $('#Recorded_Start').val(); 
           var Recorded_End = $('#Recorded_End').val(); 		   
           var id = $('#WorkedID').val(); 
		   //document.write(Recorded_Start);
		   //document.write(id);
           var action = $('#action').text();  
           if(Recorded_Start != '' && Recorded_End != '')  
           {  
				//document.write(action);
                $.ajax({  
                     url : "action.php",  
                     method:"POST",  
                     data:{Employee_ID : Employee_ID, SchedID : SchedID, Recorded_Start : Recorded_Start, Recorded_End : Recorded_End, id:id, action:action},  
                     success:function(data){  
                          alert(data);  
                          fetchUser();  
                     }  
                });  
           }  
           else  
           {  
                alert("Both Fields are Required");  
           }  
      });  
      $(document).on('click', '.update', function(){  
           var id = $(this).attr("id"); 
			//document.write(id);
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#action').text("Edit");  
                     $('#id').val(id);
					 $('#WorkedID').val(data.WorkedID);
					 $('#Employee_ID').val(data.Employee_ID);
                     $('#SchedID').val(data.SchedID);  
                     $('#Recorded_Start').val(data.Recorded_Start); 
                     $('#Recorded_End').val(data.Recorded_End);	
					 //alert(data);
                }  
           })  
      });  
      $(document).on('click', '.delete', function(){  
           var id = $(this).attr("id"); 
			//document.write(id);
           if(confirm("Are you sure you want to remove this data?"))  
           {  
                var action = "Delete";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{id:id, action:action},  
                     success:function(data)  
                     {  
                          fetchUser();  
                          alert(data);  
                     }  
                })  
           }  
           else  
           {  
                return false;  
           }  
      });  
 });  
 </script>  