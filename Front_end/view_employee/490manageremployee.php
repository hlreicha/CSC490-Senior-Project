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
<title>Manager Employee Page</title>
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

td, th {
	color: white
}

tr {
	background-color: black
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
            <h1 class="jumbomessage display-1 text-success font-weight-bold">Edit Employee</h1>
        </div>
    </div>
<!--end top of page-->
	
    <div class="container-fluid">
        <div class="row">

            <!--This is where form starts-->
			<div class="container">  
				<div class="row">
					<div class="col-12 bg-dark text-light" style="background-color:white">
						<br />
						<label>Search by Employee ID</label> 
						<br />
						<input class="form-control" input type="number" type="text" placeholder="Employee ID" aria-label="Search" id="Employee_ID1" name="Employee_ID1">
						<br />
						<button class="button" name="search" id="search" class="btn btn-warning" >Search</button>
						<button class="button" name="reset" id="reset" class="btn btn-warning" >Reset</button>
						</div>
						</div>
						<div class="row bg-dark text-light">
						<div class="col-3">
						<label>Employee ID</label>  
						<input type="number"  name="Employee_ID" id="Employee_ID" placeholder="Employee ID" class="form-control" />  
						<br /> 				
						<label>	First Name</label>  
						<input type="text" name="First_Name" id="First_Name" placeholder="First Name" class="form-control" />  
						<br />  
						<label>Last Name</label>  
						<input type="text" name="Last_Name" id="Last_Name" placeholder="Last Name" class="form-control" />  
						<br /><br />
						<label>Manager</label>
						<br /><br />						
						<label><input type="radio" name="boolean" value="True">True</label> 
                        <label><input type="radio" name="boolean" value="False">False</label> 
						<br /><br />
						<label>Password</label> 
						<h5> Please note this field is only for inserting employees. New employees have to reset their password after they login for the first time </h5>
						<input type="password" name="Password" id="Password" placeholder="Password" class="form-control" />  
						<br /><br /> 						
						<div align="center">  
						<input type="hidden" name="id" id= "id" />  
						<button type="button" name="action" id="action" class="btn btn-warning">Add</button>  
						</div>  
						</div>
						<div class="col-9 bg-dark text-light">
						<div id="result" class="table-responsive">  
						</div>
						</div>
						</div>
					</div>
				</div>				
			</div>  
        </div>
    </div>
</body>

</html>

 <script>  
$(document).ready(function(){  

    fetchUser();
	
    function fetchUser(){  
		var action = "select";  
        $.ajax({  
            url : "select.php",  
            method:"POST",  
            data:{action:action},
            success:function(data){ 
				$('#Employee_ID').val(''); 
                $('#First_Name').val('');  
                $('#Last_Name').val(''); 
				$('#isManager').val('');
				$('#Password').val('');
                $('#action').text("Add");  
                $('#result').html(data);  
            }  
        });  
    }
	
	$('#action').click(function(){
		var id = $('#id').val(); 
		//document.write(id);
		var Employee_ID = $('#Employee_ID').val();
		var First_Name = $('#First_Name').val();  
		var Last_Name = $('#Last_Name').val(); 
		var isManager = $("input[name='boolean']:checked").val();;
		var Password = $('#Password').val();
		 
		var action = $('#action').text();  
		//document.write(Employee_ID);
			if(Employee_ID != '' && First_Name != '' && Last_Name != '' && isManager != ''){ 
				$.ajax({  
					url : "action.php",  
					method:"POST",  
					data:{Employee_ID : Employee_ID ,First_Name:First_Name, Last_Name:Last_Name, isManager : isManager,Password : Password, id:id, action:action},  
					success:function(data){  
						alert(data);  
						fetchUser();  
					}  
				});  
				}  
			else{    
				alert("All Fields are Required");  
				}  
		});
	  
	$(document).on('click', '.update', function(){  
    
		var id = $(this).attr("id");
    
		$.ajax({  
			url:"fetch.php",  
			method:"POST",  
			data:{id:id},  
			dataType:"json",  
			success:function(data){
				$('#action').text("Edit");  
				$('#id').val(id);  
				$('#Employee_ID').val("Employee ID cannot be changed.");
				$('#First_Name').val(data.First_Name);  
				$('#Last_Name').val(data.Last_Name); 
				$('#boolean').val(data.isManager);
				//$('#Password').val("Password cannot be changed here");
			}  
		})  
	});  
      
	$(document).on('click', '.delete', function(){  

		var id = $(this).attr("id"); 
		var empID = '<?php echo $empID; ?>';

		if(confirm("Are you want to fire this employee?")){
                
			var action = "Delete";  
        
			$.ajax({  
				url:"action.php",  
				method:"POST",  
				data:{id:id, action:action, empID : empID},  
				success:function(data){ 
					fetchUser();  
					alert(data);  
				}  
			})  
		}
		else{  
			return false;  
		} 
	});
	 $('#search').click(function(){
		var search = $('#search').text();
		var Employee_ID1 = $('#Employee_ID1').val(); 
        //document.write(Employee_ID1)
        $.ajax({  
            url : "select.php",  
            method:"POST",  
            data:{search : search , Employee_ID1 : Employee_ID1},
            success:function(data){ 
				$('#Employee_ID').val(''); 
                $('#First_Name').val('');  
                $('#Last_Name').val(''); 
				$('#isManager').val('');
				$('#Password').val('');
                $('#action').text("Add");  
                $('#result').html(data);  
		        //alert(data);
					}  
				})  
		});
	$('#reset').click(function(){
		var reset = $('#reset').text();
		var Employee_ID1 = $('#Employee_ID1').val(); 
        //document.write(Employee_ID1)
        $.ajax({  
            url : "select.php",  
            method:"POST",  
            data:{reset : reset , Employee_ID1 : Employee_ID1},
            success:function(data){ 
				$('#Employee_ID').val(''); 
                $('#First_Name').val('');  
                $('#Last_Name').val(''); 
				$('#isManager').val('');
				$('#Password').val('');
                $('#action').text("Add");  
                $('#result').html(data);  
		        //alert(data);
					}  
				})  
			$('#Employee_ID1').val('');
		});

	
});  
</script>