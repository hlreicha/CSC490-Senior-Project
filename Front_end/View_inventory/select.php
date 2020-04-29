<?php  
 //select.php  

function connection() { 
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	return $connect;
}
	 $output = ''; 
	$connect = connection();
    if(isset($_POST["search"])) {
		search($connect,$output);
	}
	if(isset($_POST["action"]))  
   {
	    select($connect,$output);
   }
   
	if(isset($_POST["reset"]))  
   {
	    select($connect,$output);
   }

function select($connect,$output) {
 //if(isset($_POST["action"]) Or $check == True)  
 //{  
      $procedure = "  
      CREATE PROCEDURE selectUser()  
      BEGIN  
      SELECT * FROM inventory ORDER BY ProductID;  
      END;  
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS selectUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
                $query = "CALL selectUser()";  
                $result = mysqli_query($connect, $query);  
                $output .= '  
                     <table class="table table-bordered" style="color: black">  
                          <tr>  
						       
                               <th width="20%">ProductID</th>  
                               <th width="20%">Name</th> 
							   <th width="20%">Quantity</th> 
                               <th width="20%">Update</th>  
                               <th width="20%">Delete</th>  
                          </tr>  
                ';  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                          $output .= '  
                               <tr>  
							        
                                    <td>'.$row["ProductID"].'</td>  
                                    <td>'.$row["Name"].'</td> 
                                    <td>'.$row["Quantity"].'</td> 									
                                    <td><button type="button" name="update" id="'.$row["InventoryID"].'" class="update btn btn-success btn-xs">Update</button></td>  
                                    <td><button type="button" name="delete" id="'.$row["InventoryID"].'" class="delete btn btn-danger btn-xs">Delete</button></td>  
                               </tr>  
                          ';  
                     }  
                }  
                else  
                {  
                     $output .= '  
                          <tr>  
                               <td colspan="5">Data not Found</td>  
                          </tr>  
                     ';  
                }  
                $output .= '</table>';  
                echo $output;  
           }  
      }  
 //}
return 0;
}
function search($connect,$output) {
 //if(isset($_POST["search"]))  
 //{  
      $ProductID = mysqli_real_escape_string($connect, $_POST["ProductID1"]); 
      $procedure = "  
      CREATE PROCEDURE searchUser(id int(11))  
      BEGIN  
      SELECT * FROM `inventory` WHERE `ProductID` = id;  
      END;  
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS searchUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
				
				
				//echo "the productID is: " . $ProductID;
                $query = "CALL searchUser('".$ProductID."')";  
                $result = mysqli_query($connect, $query)or die(mysqli_error($connect));  
                $output .= '  
                     <table class="table table-bordered">  
                          <tr>  
						      
                               <th width="20%">ProductID</th>  
                               <th width="20%">Name</th> 
							   <th width="20%">Quantity</th> 
                               <th width="20%">Update</th>  
                               <th width="20%">Delete</th>  
                          </tr>  
                ';  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                          $output .= '  
                               <tr>  
							        
                                    <td>'.$row["ProductID"].'</td>  
                                    <td>'.$row["Name"].'</td> 
                                    <td>'.$row["Quantity"].'</td> 									
                                    <td><button type="button" name="update" id="'.$row["InventoryID"].'" class="update btn btn-success btn-xs">Update</button></td>  
                                    <td><button type="button" name="delete" id="'.$row["InventoryID"].'" class="delete btn btn-danger btn-xs">Delete</button></td>  
                               </tr>  
                          ';  
                     }  
                }  
                else  
                {  
					                  
                     $output .= '  
                          <tr>  
                               <td colspan="5">Data not Found</td>  
                          </tr>  
                     ';
					
                }  
                $output .= '</table>';  
                echo $output;

           }  
      }  
 //}
return 0;
} 
 ?>     