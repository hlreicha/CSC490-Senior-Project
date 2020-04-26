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
           $ProductID = mysqli_real_escape_string($connect, $_POST["ProductID"]);  
           $Name = mysqli_real_escape_string($connect, $_POST["Name"]);
		   $Quantity = mysqli_real_escape_string($connect, $_POST["Quantity"]);
           $procedure = "  
                CREATE PROCEDURE insertUser(IN ProductID int(11), Quantity int(11), Name char(25))  
                BEGIN  
                INSERT INTO inventory(ProductID, Quantity, Name) VALUES (ProductID, Quantity, Name);   
                END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS insertUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL insertUser('".$ProductID."','".$Quantity."', '".$Name."')"; 
						//echo "cbt?: " .$ProductID;
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));  
                     echo 'Data Inserted';  
                }  
           }  
      }  
      if($_POST["action"] == "Edit")  
      {    $InventoryID = mysqli_real_escape_string($connect, $_POST["InventoryID"]); 
		   $ProductID = mysqli_real_escape_string($connect, $_POST["ProductID"]); 
           $Quantity = mysqli_real_escape_string($connect, $_POST["Quantity"]);  
           $Name = mysqli_real_escape_string($connect, $_POST["Name"]); 
		   $id = mysqli_real_escape_string($connect, $_POST["id"]);		   
           $procedure = "  
                CREATE PROCEDURE updateUser(id int(11), ProductID int(11), Quantity int(11), Name char(25))  
                BEGIN   
                UPDATE inventory SET ProductID = ProductID, Quantity = Quantity, Name = Name  
                WHERE InventoryID = id;  
                END;   
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
				     //echo "ProductID is: " . $InventoryID;
                     $query = "CALL updateUser('".$id."','".$ProductID."', '".$Quantity."', '".$Name."')";  
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
           DELETE FROM inventory WHERE InventoryID = id;  
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