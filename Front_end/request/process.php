<?php

session_start();
if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];
}
else
	{
	header("location:../login/index.php");
	}



$requestStartDate = $_POST['startDate'];

$requestEndDate = $_POST['endDate'];


getAllDays($requestStartDate,$requestEndDate);

Function getAllDays($first,$last){
	date_default_timezone_set('America/New_York');
	//$st_date = '2012-07-20';
	//$ed_date = '2012-07-27';
	//echo "This is the first date: ". $first . ". ";
	$dates = range(strtotime($first), strtotime($last),86400);
	//print_r($dates);
	//print(date('Y-m-d',$dates[15]));
	//echo count($dates);
	//for loop to send each day in the selected day range into the functions below
	$count = count($dates);
	//echo " Dates being sent to the function: ";
	//for($i = 0; $i < count($dates);$i++){
	//$requestDate = date("m/d/y",$dates[$i]);
	//is21DaysAdvance($dates[$i]);
	//echo "  ";
	//echo $dates[i];
	//}
	
	$i = 0;
	$check = True;
	while($i < count($dates) and $check == True){
		
		$check = is21DaysAdvance($dates[$i]);
		
		if($check == False) {
			//echo "Duplicate Entry for " . $errorDate;
		}
		
		if($i == count($dates) - 1 and $check == True) {
			echo "Requested Submitted";
		}
		$i++;
		
		
	}
	return 0;
	
}

//Checks if its 21 days in advance
function is21DaysAdvance($requestDate){

	$check = True;
	$date = date("m/d/Y");
	$currentTimestamp = strtotime($date);
	$requestTimeStamp = $requestDate;

	$time_check =  $requestTimeStamp - $currentTimestamp;

	//If condition to check if it 21 days
	if($time_check < 604800) {
		$check = False;
		echo "You cant request days off that is less then 7 days in advance";
		return $check;
	}
	// 
	elseif ($time_check >= 604800) {
		$check = insertRequest($requestTimeStamp);
		return $check;
		//echo "Request Submitted ". $requestDate ."  ";
	}

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
	//echo " the day is: " . $day . "  ";
	return $day;
}

//Inserts request into the database
function insertRequest($requestTimeStamp){
	$check2 = True;
	$conn = connection();
	//$empID = 0;
	global $empID;
	//echo "the empID is: " . $empID;
	//Get schedule id from the requested date
	$schedID = getSchedID(False, $requestTimeStamp);
	$daycode = getDayCode($requestTimeStamp);
	$sql = "SELECT * FROM request WHERE Employee_ID = $empID and Day = $requestTimeStamp";
	$sql1 = "INSERT INTO request (Employee_ID,SchedID,DayCode, Day, Reason) VALUES ($empID, $schedID, $daycode, $requestTimeStamp, 'hey man')";
	
	$duplicate=mysqli_query($conn,$sql);
	if (mysqli_num_rows($duplicate)>0){
		$errorDate = date("m/d/y",$requestTimeStamp);
		echo "Duplicate request for: " . $errorDate;
		$check2 = False;
		return $check2;
		
	}
	elseif($conn->query($sql1) === TRUE) {
		//echo " New record created successfully";
		return $check2;
	} 
	else {
		echo "Error: " . $sql1 . "<br>" . $conn->error;
		$check2 = False;
		return $check2;
	}
	



	$conn->close();
	
	//return $requestTimeStamp;
	
}

//view schedule functions

function getSchedID($currentTime, $requestTimeStamp) {
	date_default_timezone_set('America/New_York');
	
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

?>