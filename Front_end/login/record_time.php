<html>
<head>
<meta charset="utf-8">
<!--this allows the webpage to be the length and zoom of device being used-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--other classes for database communication-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!--this is the information taken from getbootstrap.com-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
	<form action="" method="POST"><!--begin form to input time-->
		<button name="click" type="click" class="btn btn-primary btn-lg btn-block">Clock In</button><!--primary button to clock in/out-->
	</form><!--end form-->
</body>
</html>
 

<?php 
session_start();
if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];
}
else
	{
	header("location:index.php");
	}



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
	
	function get_isSched($empID,$schedID, $dayCode){
	 //checks if the user already clocks in. Returns true(1) or false (0)
	 $conn = connection();
	 $SQL = "Select * from worked where SchedID = $schedID and Employee_ID = $empID and DayCode = $dayCode and isClockedIN = 1";



     $duplicate=mysqli_query($conn,$SQL) or die(mysqli_error());
	 while($row = mysqli_fetch_assoc($duplicate)) {
		$isSched = $row['isSched'];
		//echo "the isSched from the function is: " .$isSched . "<br>";
} 
	
	 return $isSched;
	 
}

function get_hoursWorked($empID,$schedID, $dayCode, $date_clicked) {
         //gets hours worked in the shift. Get clocked out time - recorded start time
		$start = get_StartTime($empID,$schedID,$dayCode);
		
 
       $hoursWorked = $date_clicked - $start;
	   //echo "hours worked is: " . $hoursWorked . "<br>";
	
	 return $hoursWorked;
	
}

function get_StartTime($empID,$schedID, $dayCode){
	//get recorded start time. Originally this function was in get_HoursWorked but I  split it to experiment with something.
	$conn = connection();
	 $SQL = "Select * from worked where SchedID = $schedID and Employee_ID = $empID and DayCode = $dayCode and isClockedIN = 1";



     $duplicate=mysqli_query($conn,$SQL) or die(mysqli_error());
	 while($row = mysqli_fetch_assoc($duplicate)) {
		$start = $row['Recorded_Start'];
		//echo "the start from the function is: " .$start . "<br>";
		
} 
	 return $start;
	
	
}

function get_EndTime($empID,$schedID, $dayCode) {
	//get scheduled end time
	$conn = connection();
	 $SQL = "Select * from schedule where SchedID = $schedID and Employee_ID = $empID and DayCode = $dayCode";



     $duplicate=mysqli_query($conn,$SQL) or die(mysqli_error());
	 while($row = mysqli_fetch_assoc($duplicate)) {
		$end = $row['End_Time'];
		//echo "the start from the function is: " .$end . "<br>";
		
} 
	 return $end;
	
	
	
	
}
	

function insertToWorked($empID,$schedID,$daycode,$recorded_start,$recorded_end,$hoursWorked,$isLate,$isSched, $leftEarly, $isClockedin){
	//Insert to worked table if you are clocking in, update worked table if you are clocking out.
	
	$conn = connection();
	
	//echo "the clocked in in this function is: " . $isClockedIn . "<br>";
	if($isClockedin== 0) {
	  //sets clocked in as 1 because user just clocked in. This variable is important because if isClockedin = 1, next time user punches the user will punch out
	  $isClockedin = 1;
	  //sql insert statement
	  $insertSQL =  "INSERT INTO worked (Employee_ID,SchedID, DayCode, Recorded_Start,Recorded_End,`Hours Worked`, isLate,isSched, leftEarly, isClockedIn) 
	  VALUES ($empID,$schedID,$daycode,$recorded_start,$recorded_end,0,$isLate,$isSched, 0, $isClockedin)";
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
		//updates recorded_end, leftEarly, isClockedIn, and Hours Worked columns in the table.
		$updateSQL = "UPDATE `worked` SET `Recorded_End`= $recorded_end, `leftEarly` = $leftEarly, `isClockedIn`= $isClockedin, `Hours Worked` = $hoursWorked WHERE  `Employee_ID` = $empID and `SchedID` = $schedID and `DayCode` = $daycode and `isClockedIn` = 1";
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

	//Day Code is the number of day in the week. For example, Monday will be 1.
	 $dayCode = getDayCode($date_clicked);

     $conn = connection();
	 //$conn2 = connection();
	 
	 //session ID here
	 global $empID;
	 $checkSQL = "Select * from schedule WHERE SchedID = $schedID and Employee_ID = $empID  and DayCode = $dayCode";
	
	 $isLate = 0;
	 //$cbt = True;
	 $isScheduled = 1;
	 $leftEarly = 0;
	
	 //calls function to check if the user has previously clocked in before.
	 $clockedIN= checkWorkedTable($empID, $schedID, $dayCode);
	 //echo " clocked IN is: " . $clockedIN . "<br>";

    // clockIN = 0 means user did not clock in for the shift and must be clocked in
	if($clockedIN == 0){
	
	$result = $conn->query($checkSQL);
	if ($result->num_rows > 0){
		
		
	while ($row = $result->fetch_assoc()) {
	    
   	
		    $schedTime =$row["Start_Time"];
			//echo "This is schedtime from the for loop: " . $schedTime ."<br>";
			
			//Converts Start Time from Schedule Table to Timestamp and removes hours and minutes
			//$schedTimestamp = strtotime(date("y-m-d", $schedTime)) + 3600;
			//echo " wtf ". $schedTimestamp . "  ";
			//Converts Date_clicked date to Timestamp and removes hours and minutes
            $date_clicked_Timestamp = strtotime(date("y-m-d", $date_clicked)) + 3600;
			//echo "The date clicked in this retarded function is: " .$date_clicked. "   ";
			
			//Checks to see if you are scheduled to work
			//if($schedTimestamp == $date_clicked_Timestamp){
				
				//check to see if you are late
				$test = ($date_clicked - $schedTime);
				//echo " The sched time is: " . $schedTime . "<br>";
				//echo "The date clicked is: " . $date_clicked . "<br>";
		
	
				if( $test >= 60){
					$isLate = 1;
					//echo $isLate;
				}
				insertToWorked($empID,$schedID,$dayCode,$date_clicked,0,0,$isLate,$isScheduled,$leftEarly,$clockedIN);
				
				//echo "the day code is: " . $dayCode;
				
				
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
		//echo "emp id: " . $empID . " SchedID: " .$schedID . " Day code: " . $dayCode . " Sched Start " . $date_clicked 
		//. " Sched end: " . 0 . " is Late: " . $isLate . " is Sched: " .$isScheduled . " clocked in: " .$clockedIN . "<br>";
		
		insertToWorked($empID,$schedID,$dayCode,$date_clicked,0,0,$isLate,$isScheduled,$leftEarly,$clockedIN);
		//echo "This prints when you are not scheduled  ";
		
	}
	}
	//If you already clocked in before, it now clocks out.
	elseif($clockedIN == 1){
		//echo "the clockedIN below elseif is: " . $clockedIN ."<br>";
		$isScheduled = get_isSched($empID,$schedID, $dayCode);
		
		if($isScheduled == 0) {
		//echo " The isschedule is: " . $isScheduled . "<br>";
		$hoursWorked = get_hoursWorked($empID,$schedID, $dayCode, $date_clicked);
		
		insertToWorked($empID,$schedID,$dayCode,0,$date_clicked,$hoursWorked,$isLate,$isScheduled,$leftEarly,$clockedIN);
		}
		else if ($isScheduled == 1) {
			//get scheduled end time
			$endTime = get_EndTime($empID,$schedID,$dayCode) +3600;
			$hoursWorked = get_hoursWorked($empID,$schedID, $dayCode, $date_clicked);
			//subtract scheduled end time from clocked out time (date_clicked)
			$time = $endTime - $date_clicked;
			
			//echo "the time is: " . $time ."<br>";
			//if you leave more then 5 minutes early, leftEarly flag will be marked true.
			if($time > 300){
				$leftEarly = 1;
				
			}
			
			insertToWorked($empID,$schedID,$dayCode,0,$date_clicked,$hoursWorked,$isLate,$isScheduled,$leftEarly,$clockedIN);
			
			
			
		}
	}
	
	return 0;
	
	
	
	
}




if(isset($_POST['click']))
{
	date_default_timezone_set('America/New_York');
    $date_clicked = date('m/d/Y h:i:s a', time());
    //echo "Time the button was clicked: " . $date_clicked . "<br>";
	
	//have to add hr (+3600) for some reason to get correct time, despite setting the correct time zone.
	//If shit blows up, add +3600 and debug.
	$test = strtotime($date_clicked);
	//echo " timestamp of date is: " .$test . "<br>";
	check($test);
	
}


//header("location:login/490employeehome.php");






?>

