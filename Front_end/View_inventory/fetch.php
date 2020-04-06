<?php  
 //fetch.php  
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
 if(isset($_POST["id"]))  
 {  
      $output = array();  
      $procedure = "  
      CREATE PROCEDURE whereUser(IN id int(11))  
      BEGIN   
      SELECT * FROM inventory WHERE InventoryID = id;  
      END;   
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS whereUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
                $query = "CALL whereUser(".$_POST["id"].")";  
                $result = mysqli_query($connect, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
					 $output['InventoryID'] = $row["InventoryID"]; 
                     $output['ProductID'] = $row["ProductID"];  
					 $output['Name'] = $row["Name"];
                     $output['Quantity'] = $row["Quantity"];  
                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  
 