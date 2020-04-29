<?php
 session_start(); 
  if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];

}
else
	{
	header("location:../login/index.php");
	}

?>

<html>
<head>
<title>Change Password</title>
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

.h3pass {
	color: red;
}
</style>
</head>

<body>
<!--start top of page-->
	
    <div class="jumbotron jumbotron-fluid">
        <div class="container box">
            <!--adds the logo to the page-->
            <img src="../WJJC-logo.png" class="WJJC-logo">
            <!--at some point, have display appropriate employee id-->
            <h1 class="jumbomessage display-1 text-success font-weight-bold">Change Password</h1>
        </div>
    </div>
<!--end top of page-->


	<div class="container">
		<div>
			
			<h3 class="h3pass"> New passwords must be eight characters long and contain at least one number. </h3>
			Enter New Password: <input type="password" name="password" id="password" class="form-control"/>
		</div>
		<button type="button" name="action" id="action" class="btn btn-warning">Submit</button>
		<a href="../login/490managerhome.php" name="home" id="home" class="btn btn-warning">Home</a>  
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









