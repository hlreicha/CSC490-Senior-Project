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
<title>Edit Schedule</title>
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
            <h1 class="display-2">Edit Schedule</h1>
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
                            <a href="../login/490managerhome.php">Home</a>
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
                            <!--link to edit schedule page for managers-->
                            <a href="490editschedule.php">Edit Schedule</a><!--add link to page-->
                            </li>
                            <li>
                                <!--link to create schedule-->
                                <a href="#">Create Schedule</a><!--add link to page-->
                            </li>
                        </ul>
                        <li>
                            <!--link to inventory page for managers-->
                            <a href="490managerinventory.php">Check Inventory</a><!--add link to page-->
                        </li>
                        </li>
                        <li>
                            <!--link to instruction page for managers-->
                            <a href="#">Instructions</a><!--add link to page-->
                        </li>
                        <li>
                            <a href="../login/logout.php?logout">Log Out</a><!--log out link-->
                        </li>
                    </ul>
                    </nav>
                </div>
            </div>

            <!--This is where form starts-->
			<div class="container">  
		   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 align="center">Worked Schedule</h3>  
                <br /><br />  				
                <label>Employee ID</label>  
                <input type="text" name="Employee_ID" id="Employee_ID"  class="form-control" />  
                <br /> 				
                <label>Schedule ID</label>  
                <input type="text" name="SchedID" id="SchedID" readonly class="form-control" />  
                <br />  
                <label>Scheduled Start</label>  
                <input type="datetime-local" name="Scheduled_Start" id="Scheduled_Start" class="form-control"  />  
                <br /><br />
                <label>Scheduled End</label>  
                <input type="datetime-local" name="Scheduled_End" id="Scheduled_End" class="form-control" />  	
				<br /><br />
                <label>Position</label>  
                <input type="text" name="Position" id="Position" class="form-control" />  
                <br /><br /> 
                <div align="center">  
                     <input type="hidden" name="id" id= "id" />  
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
					 $('#Scheduled_Start').val('');
					 $('#Scheduled_End').val(''); 
                     $('#Position').val('');  					 
                     $('#action').text("Add");  
                     $('#result').html(data); 
					//alert(data);
                }  
           });  
      }  
      $('#action').click(function(){  
		   var Employee_ID = $('#Employee_ID').val();
           var SchedID = $('#SchedID').val();  
           var Scheduled_Start = $('#Scheduled_Start').val(); 
           var Scheduled_End = $('#Scheduled_End').val(); 
		   var Position = $('#Position').val(); 
           //var id = $(this).attr("id");
		   var id = $('#id').val(); 
		   //document.write(Scheduled_Start);
		   //document.write(id);
           var action = $('#action').text();  
           if(Scheduled_Start != '' && Scheduled_End != '')  
           {  
				//document.write(action);
                $.ajax({  
                     url : "action.php",  
                     method:"POST",  
                     data:{Employee_ID : Employee_ID, SchedID : SchedID, Scheduled_Start : Scheduled_Start, Scheduled_End : Scheduled_End, Position : Position, id:id, action:action},  
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
                     $('#Scheduled_Start').val(data.Scheduled_Start); 
                     $('#Scheduled_End').val(data.Scheduled_End);
					 $('#Position').val(data.Position);					 
					 //alert(data);
                }  
           })  
      });  
      $(document).on('click', '.delete', function(){  
           var id = $(this).attr("id"); 
			document.write(id);
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