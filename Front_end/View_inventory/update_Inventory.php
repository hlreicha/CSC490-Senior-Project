<html>  
      <head>  
           <title>Update Inventory</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <style>  
                body  
                {  
                     margin:0;  
                     padding:0;  
                     background-color:#f1f1f1;  
                }  
                .box  
                {  
                     width:750px;  
                     padding:20px;  
                     background-color:#fff;  
                     border:1px solid #ccc;  
                     border-radius:5px;  
                     margin-top:100px;  
                }  
           </style>  
      </head>  
      <body>  
           <div class="container">  
		   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 align="center">Inventory</h3>  
                <br /><br />  
                <br /><br />  
                <label>InventoryID</label>  
                <input type="text" name="InventoryID" id="InventoryID" readonly class="form-control" />  
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
                     <input type="hidden" name="id" id= "InventoryID" />  
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
           if(ProductID != '' && Name != '')  
           {  
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
					 $('#InventoryID').val(data.InventoryID);
                     $('#ProductID').val(data.ProductID);  
                     $('#Name').val(data.Name); 
                     $('#Quantity').val(data.Quantity);	 					 
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