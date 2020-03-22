<!-- <form action="request.php" method = POST>
<label for="request off">Request Day Off:</label>
<input type="date" name = "cbt">
<input type="submit">
</form> -->
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Request Off</title>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div class="container">
<form action="request.php" method = POST>
<label for="request off">Request Day Off:</label>
<div>
Start Date: <input id="startDate" name = "startDate" readonly width="276" />
End Date: <input id="endDate" name = "endDate" readonly width="276" />	
<input type="submit">
</div>
</form>
</div>
<script>
var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#startDate').datepicker({
uiLibrary: 'bootstrap4',
iconsLibrary: 'fontawesome',
minDate: today,
maxDate: function () {
		return $('#endDate').val();
	}
});
$('#endDate').datepicker({
uiLibrary: 'bootstrap4',
iconsLibrary: 'fontawesome',
minDate: function () {
		return $('#startDate').val();
	}
});

</script>

</body>
</html>








<?php


//echo $test;



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
	if($time_check < 1814400) {
		$check = False;
		echo "You cant request days off that is less then 21 days in advance";
		return $check;
	}
	// 
	elseif ($time_check >= 1814400) {
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
	$empID = 0;
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