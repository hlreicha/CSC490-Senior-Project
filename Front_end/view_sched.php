<?php
$servername = "3.15.184.45:3306";
$username = "mysql";
$password = "Moscow34";
$dbname = "Joe";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$schedid = noCarl1();
$empID = 1;
$sql = "SELECT Start_time, End_Time, Position FROM `Schedule` WHERE Schedule_ID = $schedid and Employee_ID = $empID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$Start = $row["Start_time"];
		$End = $row["End_Time"];
		$Start = Time1($Start);
		$End = Time1($End);
		echo "Start time: " . $Start. " End Time: " . $End. " Position " . $row["Position"]. "<br>";
	}
} else {
	echo " 0 results";
}
function Time1(Int $Time){
	$Time = "@".$Time;
	$dt = new DateTime($Time);
	$dt->setTimeZone(new DateTimeZone('America/New_York'));
	$cbt = $dt ->format('m/d/Y h:i a');
	return $cbt;
	;}
function noCarl1(){
	$startID = 1580101200;
	date_default_timezone_set('America/New_York');
	$date = date('m/d/Y h:i:s a', time());
	$date = strtotime($date);
	$day = 7;
	$week = strtotime('+7 day', $startID);
	//echo "  " .$week;
	$test = True;
	
	//$week1 = strtotime('+ $day day', $startID);
	//echo " will this work? ". $week . "  ";
	
	while($test){
		if($date > $week){
			$startID = $week;
			$week = $week + 604800;
			echo "  ". $startID . "  ";
		}

		if($date <= $week){
			$test = False;
			echo "This is the engine that the kids like " .$startID;
			
		}
	}

		return $startID;
	}
function getScheduleID(){
    date_default_timezone_set('America/New_York');
    $date = date('m/d/Y h:i:s a', time());
    $date = strtotime($date);
    $date->setTime(14, 55);
    echo $date->format('Y-m-d H:i:s') . "\n";

    return $date;




}




	?>