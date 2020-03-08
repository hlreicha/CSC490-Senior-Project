<!DOCTYPE html>
<html>
<body>

<h1>Request Day Off</h1>

<form action="request.php" method = POST>
  <label for="request off">Request Day Off:</label>
  <input type="date" name = "cbt">
  <input type="submit">
</form>


</body>
</html>
<?php
$servername = "3.134.108.106:3306";
$username = "mysql";
$password = "Moscow34";
$dbname = "Joe";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$requestDate = $_POST['cbt'];
is21DaysAdvance($requestDate,$conn);

function is21DaysAdvance($requestDate,$conn){
date_default_timezone_set('America/New_York');
//$requestDate = "2/27/2020";
$date = date("m/d/Y");
$currentTimestamp = strtotime($date);
$requestTimeStamp = strtotime($requestDate);
//echo "This is current time stamp: " .$timestamp. " This is the requested time stamp: " . $requestTimeStamp ;

$check =  $requestTimeStamp - $currentTimestamp;
if($check < 1814400) {
    echo "You cant request days off that is less then 21 days in advance";
}
elseif ($check >= 1814400) {
    insertRequest($requestTimeStamp,$conn);
	echo "Request Submitted ". $requestTimeStamp;
}

	
	
	
	return $requestDate;
}

function insertRequest($requestTimeStamp, $conn){
	$empID = 0;
	$schedID = getSchedID(False, $requestTimeStamp);
	$sql = "INSERT INTO RequestOff (Employee_ID,Schedule_Id, Day, Reason) VALUES ($empID, $schedID, $requestTimeStamp, 'hey man')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
   }

    $conn->close();
	
	return $requestTimeStamp;
	
}

function getSchedID($currentTime, $requestTimeStamp) {
	date_default_timezone_set('America/New_York');
	if($currentTime == True){
		$date = date("m/d/Y");
		$timestamp = strtotime($date);
		$day = date('w', $timestamp);
	}
	elseif ($currentTime == False){
        //echo "hello";
        $timestamp = $requestTimeStamp;
		$day = date('w', $timestamp);
        echo $timestamp;
		
	}
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

?>