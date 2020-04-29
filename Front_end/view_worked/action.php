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
	

function check($Recorded_Start,$Recorded_End,$SchedID) {
	$check = True;
	
		if($Recorded_End < $Recorded_Start) {
			   echo "User cannot finish there shift before it starts";
			   $check = False;
			   return $check;
		   }
		if($Recorded_Start < $SchedID) {
		   echo "A user cannot work before the current work week";
		   	   $check = False;
			   return $check;
		   }
		if ($Recorded_Start - $Recorded_End >= 86400) {
				echo "User cannot work for over 24 hours";
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
function isSched($SchedID,$Employee_ID,$DayCode)  {
	$connect = connection();
	$check = 0;
	$query = "select * from schedule where Employee_ID = $Employee_ID and SchedID = $SchedID and DayCode = $DayCode";
	$result = mysqli_query($connect, $query)  or die(mysqli_error($connect));
	if ($result->num_rows > 0){
		$check = 1;
		//echo "heyman";
		return $check;
	}
	else {
		//echo "cbt?";
		$check = 0;
		return $check;
	}
	
}
function isLate($SchedID,$Employee_ID,$DayCode,$Recorded_Start){
	$connect = connection();
	$check = 0;
	$query = "select * from schedule where Employee_ID = $Employee_ID and SchedID = $SchedID and DayCode = $DayCode";
	$result = mysqli_query($connect, $query)  or die(mysqli_error($connect));
	if ($result->num_rows > 0){
	 while($row = mysqli_fetch_assoc($result)) {
		$SchedStart = $row['Start_Time'];
		
		}
	}
	$test = $Recorded_Start - $SchedStart;
	if($test > 60){
		$check = 1;
		return $check;
	}
	else {
		
		return $check;
	}
}
function leftEary($SchedID,$Employee_ID,$DayCode,$Recorded_End){
	$connect = connection();
	$check = 0;
	$query = "select * from schedule where Employee_ID = $Employee_ID and SchedID = $SchedID and DayCode = $DayCode";
	$result = mysqli_query($connect, $query)  or die(mysqli_error($connect));
	if ($result->num_rows > 0){
	 while($row = mysqli_fetch_assoc($result)) {
		$SchedEnd = $row['End_Time'];
		
		}
	}
	$test = $SchedEnd - $Recorded_End;
	if($test > 300){
		$check = 1;
	
		return $check;
	}
	else {
		
		return $check;
	}
}
			   //$leftEarly = leftEary($SchedID,$Employee_ID,$DayCode,$Recorded_End)


function getDayCode($date){
    date_default_timezone_set('America/New_York');
    //$timestamp = strtotime($date);
    $day = date('w', $date);
	return $day;
}

 if(isset($_POST["action"]))  
 {  
      $output = '';  
	$connect = connection();
      if($_POST["action"] =="Add")  
      {  
           $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID"]); 
		   $SchedID = getSchedID();
           $Recorded_Start = strtotime(mysqli_real_escape_string($connect, $_POST["Recorded_Start"])); 
		   $Recorded_End = strtotime(mysqli_real_escape_string($connect, $_POST["Recorded_End"]));
		   $hours_worked = $Recorded_End - $Recorded_Start;
		   $DayCode = getDayCode($Recorded_Start);
		   $check1 = check($Recorded_Start,$Recorded_End,$SchedID);
		   $isSched = isSched($SchedID,$Employee_ID,$DayCode);
		   
		   if($isSched == 1) {
			   $isLate = isLate($SchedID,$Employee_ID,$DayCode,$Recorded_Start);
			   $leftEarly = leftEary($SchedID,$Employee_ID,$DayCode,$Recorded_End);

		   }
		   else {
			   $isLate = 0;
			   $leftEarly = 0;
		   }
			   
           $procedure = "  
                CREATE PROCEDURE insertWorked(IN Employee_ID int(11), SchedID int(11), DayCode int(10), Recorded_Start int(11), Recorded_End int(11), hours_worked int(5),isLate tinyint(1), isSched tinyint(1), leftEarly tinyint(1))  
                BEGIN  
                INSERT INTO worked(Employee_ID, SchedID, DayCode, Recorded_Start, Recorded_End, `Hours Worked`,isLate,isSched,leftEarly) VALUES (Employee_ID, SchedID, DayCode, Recorded_Start, Recorded_End, hours_worked,isLate,isSched,leftEarly);   
                END;  
           "; 

          if($check1 == True) {
				
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS insertWorked"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL insertWorked('".$Employee_ID."','".$SchedID."','".$DayCode."', '".$Recorded_Start."', '".$Recorded_End."', '".$hours_worked."', '".$isLate."', '".$isSched."', '".$leftEarly."')"; 
						//echo "cbt?: " .$ProductID;
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));  
                     echo 'Data Inserted';  
                }  
           }
		  }	
      }  
      if($_POST["action"] == "Edit")  
      {     
           $SchedID = mysqli_real_escape_string($connect, $_POST["SchedID"]); 
		   $id = $_POST["id"];
		   $Employee_ID = mysqli_real_escape_string($connect, $_POST["Employee_ID"]); 
           $Recorded_Start = strtotime(mysqli_real_escape_string($connect, $_POST["Recorded_Start"])); 
		   $Recorded_End = strtotime(mysqli_real_escape_string($connect, $_POST["Recorded_End"]));
		   $DayCode = getDayCode($Recorded_Start);
		   $hours_worked = $Recorded_End - $Recorded_Start;
		   $check = check($Recorded_Start,$Recorded_End,$SchedID);
		   $isSched = isSched($SchedID,$Employee_ID,$DayCode);
		   
		   if($isSched == 1) {
			   $isLate = isLate($SchedID,$Employee_ID,$DayCode,$Recorded_Start);
			   $leftEarly = leftEary($SchedID,$Employee_ID,$DayCode,$Recorded_End);


		   }
		   else {
			   $isLate = 0;
			   $leftEarly = 0;
		   }
           $procedure = "  
                CREATE PROCEDURE updateWorked(id int(11), Recorded_Start int(11), Recorded_End int(11), hours_worked int(5),isLate tinyint(1), isSched tinyint(1), leftEarly tinyint(1))  
                BEGIN   
                UPDATE worked SET Recorded_Start = Recorded_Start, Recorded_End = Recorded_End, `Hours Worked` = hours_worked,isLate = isLate, isSched = isSched,leftEarly = leftEarly  
                WHERE WorkedID = id;  
                END;   
           ";  

		  if($check == True) {
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS updateWorked"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
				     //echo "ProductID is: " . $id;
                     $query = "CALL updateWorked('".$id."','".$Recorded_Start."', '".$Recorded_End."', '".$hours_worked."', '".$isLate."', '".$isSched."', '".$leftEarly."')"; 
                     mysqli_query($connect, $query) or die(mysqli_error($connect));  
                     echo 'Data Updated';  
                }  
           }  
        }  
      }
	  
	  
	  if($_POST["action"] == "Delete")  
      {  
           $procedure = "  
           CREATE PROCEDURE deleteWorked(IN id int(11))  
           BEGIN   
           DELETE FROM worked WHERE WorkedID = id;  
           END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteWorked"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
			         //echo "fuck: " . $_POST["id"];
                     $query = "CALL deleteWorked('".$_POST["id"]."')";  
					 
                     mysqli_query($connect, $query)  or die(mysqli_error($connect));;  
                     echo 'Data Deleted';  
                }  
           }  
      }  
 }  
 ?>  