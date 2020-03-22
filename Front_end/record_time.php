<!DOCTYPE html>
<html>
<head>





</head>
<body>
<h2>Click</h2>
<form action="" method="POST">
    <button name="click" class="click">Click me!</button>
</form>




</body>
</html>

 

<?php 
function connection() {
	$servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
	
}

function getDayCode($date){
    date_default_timezone_set('America/New_York');
    //$timestamp = strtotime($date);
    $day = date('w', $date);
	return $day;
}

function getSchedID($currentTime, $requestTimeStamp) {
	date_default_timezone_set('America/New_York');
	//This if condition do what the daycode function do. Need to convert it.
	if($currentTime == True){
		$date = date("m/d/Y");
		$timestamp = strtotime($date) + 3600;
		$day = date('w', $timestamp);
	}
	elseif ($currentTime == False){
		//echo "hello";
		$timestamp = $requestTimeStamp + 3600;
		$day = date('w', $timestamp);
		//echo $timestamp;
		
	}
	//Switch condition where it subtracts days until Monday. If Monday, just return schedID
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







function checkWorkedTable($empID,$schedID, $dayCode){
	 //checks if the user already clocks in. Returns true(1) or false (0)
	 $conn = connection();
	 $SQL = "Select * from worked where SchedID = $schedID and Employee_ID = $empID and DayCode = $dayCode";



     $duplicate=mysqli_query($conn,$SQL) or die(mysqli_error());
	 while($row = mysqli_fetch_assoc($duplicate)) {
		$clockedIN = $row['isClockedIn'];
		//echo "the clock in is: " .$clockedIN . "<br>";
} 
//if there is no record in worked table, set clocked in value as 0. This mean the user never clocked in and have no record.
   if ($clockedIN === Null){
		$clockedIN =0;
	}
	
	 return $clockedIN;
	 
}
	

function insertToWorked($empID,$schedID,$daycode,$recorded_start,$recorded_end,$isLate,$isSched,$isClockedin){
	$conn = connection();
	if($isClockedin== 0) {
	  //sets clocked in as 1 because user just clocked in. This variable is important because if isClockedin = 1, next time user punches the user will punch out
	  $isClockedin = 1;
	  //sql insert statement
	  $insertSQL =  "INSERT INTO worked (Employee_ID,SchedID, DayCode, Recorded_Start,Recorded_End, isLate,isSched,isClockedIn) 
	  VALUES ($empID,$schedID,$daycode,$recorded_start,$recorded_end,$isLate,$isSched,$isClockedin)";
	  if($conn->query($insertSQL) === TRUE) {
		echo "Clocked In";
		return 0;
	} 
	else {
		echo "Error: " . $insertSQL . "<br>" . $conn->error;
		return 0;
	}
	  
		
	}
	
	elseif ($isClockedin== 1){
		//if the user already clocked in, set the isClockedIn variable to 0. This occurs when the user is clocking out.
		$isClockedin = 0;
		$updateSQL = "UPDATE `worked` SET `Recorded_End`= $recorded_end, `isClockedIn`= $isClockedin WHERE  `Employee_ID` = $empID and `SchedID` = $schedID and `DayCode` = $daycode";
		if($conn->query($updateSQL) === TRUE) {
		echo " Clocked Out";
		return 0;
	} 
	else {
		echo "Error: " . $updateSQL . "<br>" . $conn->error;
		return 0;
	}
		
		
	}
	
	
	
	
	
}
function check($date_clicked){
	
	 //get schedule ID for the week.
     $schedID = getSchedID(True,$date_clicked);
	// echo "schedID is: " .$schedID . "<br>";
	//Day Code is the number of day in the week. For example, Monday will be 1.
	 $dayCode = getDayCode($date_clicked);
	 //echo "the day code is: " . $dayCode . "<br>";
	 //echo "The schedule ID is:  " . $schedID . "<br>";
     $conn = connection();
	 //$conn2 = connection();
	 
	 //session ID here
	 $empID = 0;
	 
	 
	 $checkSQL = "Select * from schedule WHERE SchedID = $schedID and Employee_ID = $empID  and DayCode = $dayCode";
	
	 $isLate = 0;
	 //$cbt = True;
	 $isScheduled = 1;
	
	 //calls function to check if the user has previously clocked in before.
	 $clockedIN= checkWorkedTable($empID, $schedID, $dayCode);
	 //echo " clocked IN is: " . $clockedIN . "<br>";

    // clockIN = 0 means user did not clock in for the shift and must be clocked in
	if($clockedIN == 0){
	
	$result = $conn->query($checkSQL);
	if ($result->num_rows > 0){
		
		echo "im scared " . "<br>";
		
	while ($row = $result->fetch_assoc()) {
	    
         //echo "will it print here?";		
		    $schedTime =$row["Start_Time"];
			//echo "This is schedtime" . $schedTime;
			
			//echo "will it print here for cbt? " ;
			//Converts Start Time from Schedule Table to Timestamp and removes hours and minutes
			$schedTimestamp = strtotime(date("y-m-d", $schedTime)) + 3600;
			//echo " wtf ". $schedTimestamp . "  ";
			//Converts Date_clicked date to Timestamp and removes hours and minutes
            $date_clicked_Timestamp = strtotime(date("y-m-d", $date_clicked)) + 3600;
			//echo "The date clicked in this retarded function is: " .$date_clicked. "   ";
			
			//Checks to see if you are scheduled to work
			//if($schedTimestamp == $date_clicked_Timestamp){
				
				//check to see if you are late
				$test = $date_clicked - $schedTime;
				//echo " The test result is: " .$test;
				//echo "chowdah I require an immediate cbt";
				if( $test >= 420){
					$isLate = 1;
					//echo " cbt in if ";
					echo $isLate;
				}
				insertToWorked($empID,$schedID,$dayCode,$date_clicked,0,$isLate,$isScheduled,$clockedIN);
				
				
			//}
			//else {
				//$isScheduled = False;
				//echo "this is a test to see if the function will come here if y ou schedule on a day you dont work for but do have days scheduled in the week ";
				//insert function
				
				
			//}
			


	
	}
	}
	else {
		//in case you are not scheduled simply insert your time here
		$isScheduled = 0;
		$clockedIN = 0;
		echo "emp id: " . $empID . " SchedID: " .$schedID . " Day code: " . $dayCode . " Sched Start " . $date_clicked 
		. " Sched end: " . 0 . " is Late: " . $isLate . " is Sched: " .$isScheduled . " clocked in: " .$clockedIN . "<br>";
		insertToWorked($empID,$schedID,$dayCode,$date_clicked,0,$isLate,$isScheduled,$clockedIN);
		echo " else condition ";
		
	}
	}
	//If you already clocked in before, it now clocks out.
	elseif($clockedIN == 1){
		//echo " clocking out" . "<br>";
		insertToWorked($empID,$schedID,$dayCode,0,$date_clicked,$isLate,$isScheduled,$clockedIN);
		
	}
	
	return 0;
	
	
	
	
}




if(isset($_POST['click']))
{
	date_default_timezone_set('America/New_York');
    $date_clicked = date('m/d/Y h:i:s a', time());
    echo "Time the button was clicked: " . $date_clicked . "<br>";
	
	//have to add hr (+3600) for some reason to get correct time, despite setting the correct time zone.
	$test = strtotime($date_clicked) + 3600;
	echo " timestamp of date is: " .$test . "<br>";
	check($test);
	
}








?>

