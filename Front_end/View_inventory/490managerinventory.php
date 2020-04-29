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
<title>Manager Inventory Page</title>
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
            <h1 class="jumbomessage display-1 text-success font-weight-bold">Inventory</h1>
        </div>
    </div>
<!--end top of page-->

<!--This is where form starts-->
			<div class="container">  
				<div class="row">
					<div class="col-12 bg-dark text-light">
						<br />
						<label>Search by Product ID</label> 
                        <input class="form-control" input type="number" type="text" placeholder="Product ID" aria-label="Search" id="ProductID1" name="ProductID1">
						<br />
                        <button class="button" name="search" id="search" class="btn btn-warning" >Search</button>
						<button class="button" name="reset" id="reset" class="btn btn-warning" >Reset</button>
                        <br />

						</div>
						</div>
				<div class="row">		
					<div class="col-3 bg-dark text-light">
						<br /> 				
						<label>Product ID</label>  
						<input type="number" name="ProductID" id="ProductID" placeholder="ProductID" class="form-control" />  
						<br />  
						<label>Name</label>  
						<input type="text" name="Name" id="Name" placeholder="Name" class="form-control"  />  
						<br /><br />
						<label>Quantity</label>  
						<input type="number" name="Quantity" placeholder="Quantity" id="Quantity" class="form-control" />  
						<br />
<div align="center">						
						<button type="button" name="action" id="action" class="btn btn-warning align-justify">Add</button>  
</div>	
</div>					
					<div class="col-9 bg-dark text-light">
						<div align="center">  
						<input type="hidden" name="id" id= "id" />  
						
						</div>  
						<br />  
						<br />  
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
				$('#InventoryID').val(''); 
                $('#ProductID').val('');  
                $('#Name').val(''); 
				$('#Quantity').val('');					 
                $('#action').text("Add");  
                $('#result').html(data);  
            }  
        });  
    }
	
	$('#action').click(function(){
		var InventoryID = $('#InventoryID').val();
		var ProductID = $('#ProductID').val();  
		var Name = $('#Name').val(); 
		var Quantity = $('#Quantity').val(); 		   
		var id = $('#id').val();  
		var action = $('#action').text();  
			if(ProductID != '' && Name != '' && Quantity != ''){ 
				$.ajax({  
					url : "action.php",  
					method:"POST",  
					data:{InventoryID : InventoryID ,ProductID:ProductID, Name:Name, Quantity : Quantity, id:id, action:action},  
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
				$('#InventoryID').val(data.InventoryID);
				$('#ProductID').val(data.ProductID);  
				$('#Name').val(data.Name); 
				$('#Quantity').val(data.Quantity);	 					 
			}  
		})  
	});  
      
	$(document).on('click', '.delete', function(){  

		var id = $(this).attr("id"); 

		if(confirm("Are you sure you want to remove this data?")){
                
			var action = "Delete";  
        
			$.ajax({  
				url:"action.php",  
				method:"POST",  
				data:{id:id, action:action},  
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
		var ProductID1 = $('#ProductID1').val(); 
        //document.write(ProductID1);
        $.ajax({  
            url : "select.php",  
            method:"POST",  
            data:{search : search , ProductID1 : ProductID1},
            success:function(data){ 
				$('#InventoryID').val(''); 
                $('#ProductID').val('');  
                $('#Name').val(''); 
				$('#Quantity').val('');					 
                $('#action').text("Add");  
                $('#result').html(data); 
		        //alert(data);
					}  
				})  
		});
$('#reset').click(function(){
		var reset = $('#reset').text();
		var ProductID1 = $('#ProductID1').val(); 
       
        $.ajax({  
            url : "select.php",  
            method:"POST",  
            data:{reset : reset , ProductID1 : ProductID1},
            success:function(data){ 
			
				$('#ProductID1').val(''); 
				$('#InventoryID').val(''); 
                $('#ProductID').val('');  
                $('#Name').val(''); 
				$('#Quantity').val('');					 
                $('#action').text("Add");  
                $('#result').html(data); 
		        //alert(data);
					}  
				})  
		});
	
});  
</script>