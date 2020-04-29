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

function convertBool(int $i) {
	if ($i == 1) {
		$i = "True";
	return $i; 
	}
	elseif ($i == 0) {
		$i = "False";
		return $i;
	}
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
 //if(isset($_POST["action"]))  
 //{  
      $procedure = "  
      CREATE PROCEDURE selectUser()  
      BEGIN  
      SELECT * FROM employee ORDER BY Employee_ID DESC;  
      END;  
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS selectUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
                $query = "CALL selectUser()";  
                $result = mysqli_query($connect, $query);  
                $output .= '  
                     <table class="table table-bordered">  
                          <tr>  
						       <th width="20%">EmployeeID</th> 
                               <th width="20%">First Name</th>  
                               <th width="20%">Last Name</th>
							   <th width="20%">isManager</th>   
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
							        <td>'.$row["Employee_ID"].'</td> 
                                    <td>'.$row["First_Name"].'</td>  
                                    <td>'.$row["Last_Name"].'</td> 
                                    <td>'.convertBool($row["isManager"]).'</td> 									
                                    <td><button type="button" name="update" id="'.$row["Employee_ID"].'" class="update btn btn-success btn-xs">Update</button></td>  
                                    <td><button type="button" name="delete" id="'.$row["Employee_ID"].'" class="delete btn btn-danger btn-xs">Delete</button></td>  
                               </tr>  
                          ';  
                     }  
                }  
                else  
                {  
                     $output .= '  
                          <tr>  
                               <td colspan="6">Data not Found</td>  
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
      $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID1"]); 
      $procedure = "  
      CREATE PROCEDURE searchUser(id1 int(11))  
      BEGIN  
      SELECT * FROM `employee` WHERE `Employee_ID` = id1;  
      END;  
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS searchUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
				
				
				//echo "the empid is: " . $EmployeeID;
                $query = "CALL searchUser('".$Employee_ID."')";  
                $result = mysqli_query($connect, $query)or die(mysqli_error($connect));  
                $output .= '  
                     <table class="table table-bordered">  
                          <tr>  
						       <th width="20%">EmployeeID</th> 
                               <th width="20%">First Name</th>  
                               <th width="20%">Last Name</th>
							   <th width="20%">isManager</th>  > 
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
									<td>'.$row["Employee_ID"].'</td> 
                                    <td>'.$row["First_Name"].'</td>  
                                    <td>'.$row["Last_Name"].'</td> 
                                    <td>'.convertBool($row["isManager"]).'</td> 									
                                    <td><button type="button" name="update" id="'.$row["Employee_ID"].'" class="update btn btn-success btn-xs">Update</button></td>  
                                    <td><button type="button" name="delete" id="'.$row["Employee_ID"].'" class="delete btn btn-danger btn-xs">Fire</button></td>
                               </tr>  
                          ';  
                     }  
                }  
                else  
                {  
                     $output .= '  
                          <tr>  
                               <td colspan="6">Data not Found</td>  
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