<html>  
      <head>  
           <title>Inventory Page</title> 

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <style>  
            <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

		   
		   
		   
		   
		   
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
		   
		   
		   
    </style>
		   
      </head>  
      <body>  
           <div class="container">  
		   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 align="center">Inventory</h3>  
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