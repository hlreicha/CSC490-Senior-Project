 <?php  
 //action.php
date_default_timezone_set('America/New_York'); 
function connection() {
	     
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	return $connect;
}

function check($Scheduled_Start,$Scheduled_End,$SchedID) {
	$check = True;
	
		if($Scheduled_End < $Scheduled_Start) {
			   echo "User cannot finish there shift before it starts";
			   $check = False;
			   return $check;
		   }
		if($Scheduled_Start < $SchedID) {
		   echo "A user cannot be scheduled to work before the current work week";
		   	   $check = False;
			   return $check;
		   }
		if ($Scheduled_Start - $Scheduled_End >= 86400) {
				echo "User cannot be scheduled to work for over 24 hours";
			   $check = False;
			   return $check;
		   }
	
	return $check;
	
}

function getSchedID() {
    date_default_timezone_set('America/New_York');
	//echo date_default_timezone_get (  );
    $date = date("m/d/Y");
    $timestamp = strtotime($date)+3600;
	//$timestamp = strtotime($date);
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
			echo"the sched id is: " .  $schedid;
            return $schedID;
            break;
    }

}
function getDayCode($date){
    date_default_timezone_set('America/New_York');
    //$timestamp = strtotime($date);
    $day = date('w', $date);
	return $day;
}


function upWorked($SchedID,$Employee_ID,$DayCode, $Scheduled_Start, $Scheduled_End) {
	$connect = connection();
	$connect2 = connection();
	//$hours_worked = 0;
	$isLate = 0;
	$leftEarly = 0;
	$isSched = 0;
	$query = "select * from worked where Employee_ID = $Employee_ID and SchedID = $SchedID and DayCode = $DayCode";

     //echo "Employee_ID: " . $Employee_ID;       
	$result = mysqli_query($connect, $query)  or die(mysqli_error($connect));
	if ($result->num_rows > 0){
	 while($row = mysqli_fetch_assoc($result)) {
		$isSched = 1;
		$Recorded_Start = $row['Recorded_Start'];
		$Recorded_End = $row['Recorded_End'];
		$test = $Recorded_Start - $Scheduled_Start;
		$test2 = $Scheduled_End - $Recorded_End;
		if($test > 60 And $test <= 7200) {
			//echo "fuck";
			$isLate = 1;
		}
		else if ($test2 > 300 and $test <= 7200) {
			$leftEarly = 1;
		}
		
		//return 0;
	
		}
		$update = "UPDATE worked SET isLate = $isLate, isSched = $isSched, leftEarly = $leftEarly WHERE Employee_ID = $Employee_ID and SchedID = $SchedID and DayCode = $DayCode"; 
		$result = mysqli_query($connect2, $update)  or die(mysqli_error($connect));
	}
	return 0;
}
	




 if(isset($_POST["action"]))  
 {  
      $output = '';  
	$connect = connection();
      if($_POST["action"] =="Add")  
      {  
         
		   $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID"]); 
		   $SchedID = getSchedID();
           $Scheduled_Start = strtotime(mysqli_real_escape_string($connect, $_POST["Scheduled_Start"])); 
		   $Scheduled_End = strtotime(mysqli_real_escape_string($connect, $_POST["Scheduled_End"]));
		   $Position = mysqli_real_escape_string($connect, $_POST["Position"]);
		   $DayCode = getDayCode($Scheduled_Start);
		   $check1 = check($Scheduled_Start,$Scheduled_End,$SchedID);
           $procedure = "  
                CREATE PROCEDURE insertSched(IN SchedID int(11),Employee_ID int(11), DayCode int(10), Scheduled_Start int(11), Scheduled_End int(11), Position varchar(25))  
                BEGIN  
                INSERT INTO schedule(SchedID,Employee_ID, DayCode, Start_Time, End_Time, `Position`) VALUES (SchedID,Employee_ID, DayCode, Scheduled_Start, Scheduled_End, Position);   
                END;  
           "; 
		   //$cbt = mysqli_query($connect, "DROP PROCEDURE IF EXISTS insertUser") or die(mysqli_error($connect);
          if($check1 == True) {
				
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS insertSched"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL insertSched('".$SchedID."','".$Employee_ID."','".$DayCode."', '".$Scheduled_Start."', '".$Scheduled_End."', '".$Position."')"; 
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));  
					 upWorked($SchedID,$Employee_ID,$DayCode, $Scheduled_Start, $Scheduled_End);
                     echo 'Data Inserted';  
                }  
           }
		  }	
      }  
      if($_POST["action"] == "Edit")  
      {    
		   $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID"]); 
           $SchedID = mysqli_real_escape_string($connect, $_POST["SchedID"]); 
		   $id = $_POST["id"];
           $Scheduled_Start = strtotime(mysqli_real_escape_string($connect, $_POST["Scheduled_Start"])); 
		   $Scheduled_End = strtotime(mysqli_real_escape_string($connect, $_POST["Scheduled_End"]));
		   $Position = mysqli_real_escape_string($connect, $_POST["Position"]);
		   $DayCode = getDayCode($Scheduled_Start);
		   $check = check($Scheduled_Start,$Scheduled_End,$SchedID);
           $procedure = "  
                CREATE PROCEDURE updateSched(id int(5), Scheduled_Start int(11), Scheduled_End int(11), Position varchar(25))  
                BEGIN   
                UPDATE schedule SET Start_Time = Scheduled_Start, End_Time = Scheduled_End, `Position` = Position 
                WHERE SchedIndex = id;  
                END;   
           ";  
		   if($check == True) {
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS updateSched"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
				     //echo "ProductID is: " . $id;
                     $query = "CALL updateSched('".$id."','".$Scheduled_Start."', '".$Scheduled_End."', '".$Position."')";  
                     mysqli_query($connect, $query) or die(mysqli_error($connect)); 
					 upWorked($SchedID,$Employee_ID,$DayCode, $Scheduled_Start, $Scheduled_End);
                     echo 'Data Updated';  
                }  
           }  
		   }
      }
	  
	  
	  if($_POST["action"] == "Delete")  
      {  
           $procedure = "  
           CREATE PROCEDURE deleteSched(IN id int(5))  
           BEGIN   
           DELETE FROM schedule WHERE SchedIndex = id;  
           END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteSched"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
			         echo "fuck: " . $_POST["id"];
                     $query = "CALL deleteSched('".$_POST["id"]."')";  
					 
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));;  
                     echo 'Data Deleted';  
                }  
           }  
      }  
 }  
 ?>  