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
.jumbotron {
    background-image: url("../cupbackground.jpg");
    background-size: cover;
}

body {
	
	
		background: url("../coffee-beans-.jpg") no-repeat center center fixed
		
}
</style>

</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="float-left">
            <!--at some point, have display appropriate employee id-->
            <h1 class="display-1 text-success font-weight-bold">Inventory</h1>
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
					<div class="col-lg-10 col-md-10 col-sm-6" style="background-color:white">
						<h3 align="center">Inventory</h3>  
						<br /><br />  
						<br /><br /> 
						<label>Search by Product ID</label> 
                        <input class="form-control" type="text" placeholder="By Product ID" aria-label="Search" id="ProductID1" name="ProductID1">
                        <button class="button" name="search" id="search" class="btn btn-warning" >Search</button>
						<button class="button" name="reset" id="reset" class="btn btn-warning" >Reset</button>
                        <br /><br /> 					  
						<br /> 				
						<label>Product ID</label>  
						<input type="text" name="ProductID" id="ProductID" class="form-control" />  
						<br />  
						<label>Name</label>  
						<input type="text" name="Name" id="Name" class="form-control" />  
						<br /><br />
						<label>Quantity</label>  
						<input type="text" name="Quantity" id="Quantity" class="form-control" />  
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
        </div>
    </div>
</body>

</html>

 <script>  
$(document).ready(function(){  

    fetchUser();
	
    function fetchUser(){  
		var action = "select"; 
		
		//document.write(ProductID1);
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
				//alert(data);
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
			if(ProductID != '' && Name != ''){ 
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
				alert("Both Fields are Required");  
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
        //document.write(ProductID1);
        $.ajax({  
            url : "select.php",  
            method:"POST",  
            data:{reset : reset , ProductID1 : ProductID1},
            success:function(data){ 
				$('#InventoryID').val(''); 
                $('#ProductID').val('');  
                $('#Name').val(''); 
				$('#Quantity').val('');					 
                $('#action').text("Add");  
                $('#result').html(data); 
		        //alert(data);
					} 
				$('#ProductID1').val('');
				})  
		});		
	
});  
</script>