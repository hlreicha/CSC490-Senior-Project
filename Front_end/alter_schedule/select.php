<?php  
 //select.php  
 $output = '';  
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
function getSchedID() {
    date_default_timezone_set('America/New_York');
	//echo date_default_timezone_get (  );
    $date = date("m/d/Y");
    $timestamp = strtotime($date)+3600;
    $day = date('w', $timestamp);
	//echo "the day is: " . $day;
    switch($day) {
		
        case 1:
            $schedID = $timestamp;
			//echo $schedid;
            return $schedID; 
            break;
        case 2: 
            $schedID = strtotime('-1 day', $timestamp);
			//echo $schedid;
            return $schedID;
            break;
        case 3: 
            $schedID = strtotime('-2 day', $timestamp);
			//echo $schedid;
            return $schedID;
            break;
        case 4: 
            $schedID = strtotime('-3 day', $timestamp);
			//echo $schedid;
            return $schedID;
            break;
        case 5: 
            $schedID = strtotime('-4 day', $timestamp);
			//echo $schedid;
            return $schedID;
            break;
        case 6: 
            $schedID = strtotime('-5 day', $timestamp);
			//echo $schedid;
            return $schedID;
            break;
        case 0: 
            $schedID = strtotime('-6 day', $timestamp);
			//echo $schedid;
            return $schedID;
            break;
    }
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
	
	
 if(isset($_POST["action"]))  
 {  
      $procedure = "  
      CREATE PROCEDURE selectUser(IN id int(11))  
      BEGIN  
      SELECT * FROM schedule where SchedID = id;  
      END;  
      "; 
		//echo "fuck";
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS selectUser"))  
      {  
		//echo "shit";
		date_default_timezone_set('America/New_York');
			//$oof = mysqli_query($connect, $procedure) or die(mysqli_error($connect));
           if(mysqli_query($connect, $procedure))  
			
           {  
			//echo "fuck shit fuck";
				$SchedID = getSchedID();
				//echo $SchedID;
                $query = "CALL selectUser(".$SchedID.")";  
                $result = mysqli_query($connect, $query) or die(mysqli_error($connect));  
                $output .= '  
                     <table class="table table-bordered">  
                          <tr>  
						       <th width="15%">Employee ID</th> 
                               <th width="15%">Schedule ID</th>  
                               <th width="15%">Scheduled Start</th> 
							   <th width="15%">Scheduled End</th>
							   <th width="15%">Position</th>							   
                               <th width="8%">Update</th> 
							   <th width="8%">Delete</th>
                              
                          </tr>  
                ';  
                if(mysqli_num_rows($result) > 0)
						
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
				 
						 
						$Start = date('m/d/Y h:i A', $row["Start_Time"]);
						$End = date('m/d/Y h:i A', $row["End_Time"]);
						$Position = $row["Position"];
						
                          $output .= '  
                               <tr>   
							        <td>'.$row["Employee_ID"].'</td> 
                                    <td>'.$SchedID.'</td>  
                                    <td>'.$Start.'</td>
                                    <td>'.$End.'</td> 
                                    <td>'.$Position.'</td>  									
                                    <td><button type="button" name="update" id="'.$row["SchedIndex"].'" class="update btn btn-success btn-xs">Update</button></td> 
									<td><button type="button" name="delete" id="'.$row["SchedIndex"].'" class="delete btn btn-danger btn-xs">Delete</button></td>
                                  
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