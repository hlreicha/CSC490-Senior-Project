<?php  
 //fetch.php  
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	 date_default_timezone_set('America/New_York');
 if(isset($_POST["id"]))  
 {  
      $output = array();  
      $procedure = "  
      CREATE PROCEDURE whereUser(IN id int(11))  
      BEGIN   
      SELECT * FROM worked WHERE WorkedID  = id;  
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
					 $output['WorkedID'] = $row["WorkedID"]; 
					 $output['Employee_ID'] = $row["Employee_ID"]; 
                     $output['SchedID'] = $row["SchedID"];  
					 $output['Recorded_Start'] = date('Y-m-d\TH:i', $row["Recorded_Start"]);
                     $output['Recorded_End'] = date('Y-m-d\TH:i', $row["Recorded_End"]);  
                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  