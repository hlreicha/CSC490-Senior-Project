<!-- <form action="request.php" method = POST>
<label for="request off">Request Day Off:</label>
<input type="date" name = "cbt">
<input type="submit">
</form> -->
<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
}
else
	{
	header("location:../login/index.php");
	}
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Request Off</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


</head>
<body>

<div class="container">
<form action="request.php" method = POST>
<label for="request off">Request Day Off:</label>
<div>
Start Date: <input id="startDate" name = "startDate" class="form-control" readonly type="date" />
End Date: <input id="endDate" name = "endDate" class="form-control" readonly type="date"/>	
<button type="button" name="action" id="action" class="btn btn-warning">Submit</button>
</div>
</form>
</div>
<script>
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
                     url : "process.php",  
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









