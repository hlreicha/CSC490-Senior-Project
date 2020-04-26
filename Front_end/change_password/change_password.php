
<!DOCTYPE html>
<?php
session_start();
  if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['pw'];
  $empID = $_SESSION['User'];
  
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
<title>Change Password</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


</head>
<body>

<div class="container">

<div>
<h1> If you are a new user, you have to set your own password</h1>
<h2> New passwords has to be: 8 characters long and has a number in it. </h2>
Enter New Password: <input type="password" name="password" id="password" class="form-control"/>
</div>
<button type="button" name="action" id="action" class="btn btn-warning">Submit</button>  
<a href="#" onclick="location.href = document.referrer; return false;"> Back</a>
</div>



<script>



$('#action').click(function(){  
           var password = $('#password').val(); 
           var action = $('#action').text();  
           if(password != '' )  
           {  
				//document.write(password);
                $.ajax({  
                     url : "process.php",  
                     method:"POST",  
                     data:{password : password, action:action},  
                     success:function(data){  
                          alert(data); 
						  window.location.href = "../login/490managerhome.php";
                     }  
                });  
				$('#password').val('');
           }  
           else  
           {  
                alert("Not Filled");  
           }  
		   
      });   


</script>

</body>
</html>









