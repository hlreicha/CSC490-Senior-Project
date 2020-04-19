 <?php  
 //action.php  
 if(isset($_POST["action"]))  
 {  
      $output = '';  
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
      if($_POST["action"] =="Add")  
      {  
           
		   $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID"]); 
		   $First_Name= mysqli_real_escape_string($connect, $_POST["First_Name"]); 
           $Last_Name = mysqli_real_escape_string($connect, $_POST["Last_Name"]);  
           $isManager = mysqli_real_escape_string($connect, $_POST["isManager"]);
		   $Password = mysqli_real_escape_string($connect, $_POST["Password"]);
		   $changePW = 1;
           $procedure = "  
                CREATE PROCEDURE insertUser(Employee_ID int(11), First_Name varchar(12), Last_Name varchar(25), Password varchar(15), isManager tinyint(1), changePW tinyint(1) )  
                BEGIN  
                INSERT INTO employee(Employee_ID,First_Name,Last_Name,Password, isManager, changePW) VALUES (Employee_ID,First_Name,Last_Name,Password, isManager, changePW);   
                END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS insertUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL insertUser('".$Employee_ID."','".$First_Name."', '".$Last_Name."',
					 '".$Password."','".$isManager."','".$changePW."')"; 
						//echo "cbt?: " .$ProductID;
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));  
                     echo 'Data Inserted';  
                }  
           }  
      }  
      if($_POST["action"] == "Edit")  
      {    
           $id = $_POST["id"];
		   $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID"]); 
		   $First_Name= mysqli_real_escape_string($connect, $_POST["First_Name"]); 
           $Last_Name = mysqli_real_escape_string($connect, $_POST["Last_Name"]);  
           $isManager = mysqli_real_escape_string($connect, $_POST["isManager"]);  
		   //echo "This emp id is: " . $Employee_ID;
           $procedure = "  
                CREATE PROCEDURE updateUser(id int(11), First_Name varchar(12), Last_Name 	varchar(25), isManager tinyint(1))  
                BEGIN   
                UPDATE employee SET First_Name = First_Name, Last_Name = Last_Name, isManager = isManager  
                WHERE Employee_ID = id;  
                END;   
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
				     //echo "ProductID is: " . $_POST["id"];
                     $query = "CALL updateUser('".$id."','".$First_Name."', '".$Last_Name."', '".$isManager."')";  
                     mysqli_query($connect, $query) or die(mysqli_error($connect));  
                     echo 'Data Updated';  
                }  
           }  
      }  
      if($_POST["action"] == "Delete")  
      {  
           $procedure = "  
           CREATE PROCEDURE deleteUser(IN id int(11))  
           BEGIN   
           DELETE FROM employee WHERE Employee_ID = id;  
           END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
			         //echo "fuck: " . $_POST["id"];
                     $query = "CALL deleteUser('".$_POST["id"]."')";  
					 
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));;  
                     echo 'Data Deleted';  
                }  
           }  
      }  
 }  
 ?>  