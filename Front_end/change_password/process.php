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
function connection() {
	$servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("connion failed: " . mysqli_conn_error());
	}
	return $conn;
}
if(isset($_POST["action"])){
    $conn = connection();
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$check = checkPW($empID, $password);
	$changePW = 0;
	
	if($check == 1) {
	 $procedure = "  
                CREATE PROCEDURE changePassword(id int(11), pw varchar(25), changePW tinyint(1))  
                BEGIN  
                Update employee SET Password = pw, changePW = changePW WHERE Employee_ID = id;   
                END;  
           "; 
		   
           if(mysqli_query($conn, "DROP PROCEDURE IF EXISTS changePassword"))  
           {  
                if(mysqli_query($conn, $procedure))  
                {  
				     //echo "ProductID is: " . $empID;
                     $query = "CALL changePassword('".$empID."','".$password."','".$changePW."')";  
                     mysqli_query($conn, $query) or die(mysqli_error($conn));
					 $_SESSION['pw'] = $changePW;
                     echo 'Data Updated';  
                }  
           }
		}		   
      } 

function checkPW($empID, $password) {
	//echo "cbt? " . $password;
		$conn = connection();
		$check = 1;
		$procedure = "  
                CREATE PROCEDURE checkPassword(id int(11))  
                BEGIN  
                Select * from employee WHERE Employee_ID = id;   
                END;  
           ";
   if(mysqli_query($conn, "DROP PROCEDURE IF EXISTS checkPassword"))  
      {		  
           if(mysqli_query($conn, $procedure))  
           {  
				
				
				//echo "the empid is: " . $empID;
                $query = "CALL checkPassword('".$empID."')";  
                $result = mysqli_query($conn, $query)or die(mysqli_error($conn));    
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
						//echo "cbt?";
						$previousPW = $row['Password'];
  
                     }  
                }  
  
           }  
      }  
	  //echo "previousPW is: " .$previousPW;
	  if($previousPW == $password) {
		  echo "Your new password cannot be your previous password";
		  $check = 0;
		  return $check;
	  }
	  if(strlen($password) < 8) {
		  echo "Password does not contain enough characters";
		  $check = 0;
		  return $check;
	  }
	  if(strlen($password) > 25) {
		  echo "Password has too many characters";
		  $check = 0;
		  return $check;
	  }
	  if(!preg_match('/[A-Z]/', $password)){
          echo "Password does not contain a capitalized letter";
		  $check = 0;
		  return $check;
	}
	if(!preg_match('/[0-9]/', $password)){
    echo "Password does not contain a number";
	$check = 0;
	return $check;
	}
	  
	return $check;
	
	
}





	



?>