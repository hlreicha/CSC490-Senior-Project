<?php  
 //select.php  
 $output = '';  
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
 if(isset($_POST["action"]))  
 {  
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
                                    <td>'.$row["isManager"].'</td> 									
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
 }  
 ?>  