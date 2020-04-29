<?php  
 //select.php  
 
 function connection() {
 $output = '';  
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
	
function select($connect,$output) {	
// if(isset($_POST["action"]))  
 //{  
      $procedure = "  
      CREATE PROCEDURE selectUser(IN id int(11))  
      BEGIN  
      SELECT * FROM worked where SchedID = id ORDER BY Employee_ID;  
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
					
                      <table class="table table-bordered" style="color: black"> 
                          <tr>  
							   
						       <th width="10%">Employee ID</th> 
                               <th width="15%">Recorded Start</th> 
							   <th width="15%">Recorded End</th>
						       <th width="10%">Hours Worked</th> 
                               <th width="10%">isLate</th> 
							   <th width="10%">isSched</th> 
							   <th width="10%">leftEarly</th>							   
                               <th width="10%">Update</th> 
							   <th width="10%">Delete</th>
                              
                          </tr>  
						  
                ';  
                if(mysqli_num_rows($result) > 0)
						
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
				 
						if($row["Recorded_End"] != 0){ 
						$Start = date('m/d/Y h:i A', $row["Recorded_Start"]);
						$End = date('m/d/Y h:i A', $row["Recorded_End"]);
						$Late = convertBool($row["isLate"]);
						$Sched = convertBool($row["isSched"]);
						$Left = convertBool($row["leftEarly"]);
						
                          $output .= '  
                               <tr>  
									
							        <td>'.$row["Employee_ID"].'</td> 
                                    
                                    <td>'.$Start.'</td>
                                    <td>'.$End.'</td> 
							        <td>'.gmdate("H:i:s", $row["Hours Worked"]).'</td> 
                                    <td>'.$Late.'</td>  
                                    <td>'.$Sched.'</td> 
                                    <td>'.$Left.'</td> 									
                                    <td><button type="button" name="update" id="'.$row["WorkedID"].'" class="update btn btn-success btn-xs">Update</button></td> 
									<td><button type="button" name="delete" id="'.$row["WorkedID"].'" class="delete btn btn-danger btn-xs">Delete</button></td>
                                  
                               </tr>  
                          ';  
                     
					    }
					 }  
                }  
                else  
                {  
                     $output .= '  
                          <tr>  
                               <td colspan="9">Data not Found</td>  
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
// {  
      $SchedID = getSchedID();
	  //echo "sched id is:" . $SchedID;
      $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID1"]); 
      $procedure = "  
      CREATE PROCEDURE searchUser(id int(11), schID int(11))  
      BEGIN  
      SELECT * FROM `worked` WHERE `Employee_ID` = id and `SchedID` = schID;  
      END;  
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS searchUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
				
				
			
                $query = "CALL searchUser('".$Employee_ID."', '".$SchedID."')";  
                $result = mysqli_query($connect, $query)or die(mysqli_error($connect));  
                $output .= '  
                     <table class="table table-bordered">  
                          <tr>  
							   
						       <th width="10%">Employee ID</th> 
                               <th width="15%">Recorded Start</th> 
							   <th width="15%">Recorded End</th>
						       <th width="10%">Hours Worked</th> 
                               <th width="10%">isLate</th> 
							   <th width="10%">isSched</th> 
							   <th width="10%">leftEarly</th>							   
                               <th width="10%">Update</th> 
							   <th width="10%">Delete</th>
                          </tr>  
                ';  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
				        $Start = date('m/d/Y h:i A', $row["Recorded_Start"]);
						$End = date('m/d/Y h:i A', $row["Recorded_End"]);
						$Late = convertBool($row["isLate"]);
						$Sched = convertBool($row["isSched"]);
						$Left = convertBool($row["leftEarly"]);
                          $output .= '  
                               <tr>  
									
							        <td>'.$row["Employee_ID"].'</td> 
                     
                                    <td>'.$Start.'</td>
                                    <td>'.$End.'</td> 
							        <td>'.gmdate("H:i:s", $row["Hours Worked"]).'</td> 
                                    <td>'.$Late.'</td>  
                                    <td>'.$Sched.'</td> 
                                    <td>'.$Left.'</td> 									
                                    <td><button type="button" name="update" id="'.$row["WorkedID"].'" class="update btn btn-success btn-xs">Update</button></td> 
									<td><button type="button" name="delete" id="'.$row["WorkedID"].'" class="delete btn btn-danger btn-xs">Delete</button></td> 
                               </tr>  
                          ';  
                     }  
                }  
                else  
                {  
						$output .= '  
                          <tr>  
                               <td colspan="9">Data not Found</td>  
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