<?php
$servername = "localhost";
$username = "hlreicha";
$password = "Moscow34!!";
$dbname = "Test";


session_start();
if(isset($_SESSION['User'])) {
  //echo "Your session is running " . $_SESSION['User'];
  $empID = $_SESSION['User'];
}
else
	{
	header("location:../login/index.php");
	}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
//$date = getScheduleID();
$schedid = getSchedID();
//echo "the schedid is: ". $schedid;

//main

$sql = "SELECT Start_Time, End_Time, Position FROM `schedule` WHERE SchedID = $schedid and Employee_ID = $empID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	/*
	echo statement creates table, makes header for table, and starts the table body
	this allows for a static header but for body to be filled for entirety of schedule
	*/
	echo '
		<table class="table table-dark table-striped">
			<thead>Schedule for Employee '.$empID. '</thead>
				<thead>
					<tr>
						<th>Start</th>
						<th>End</th>
						<th>Position</th>
					</tr>
				</thead>
				<tbody>
		';
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$Start = $row["Start_Time"];
		$End = $row["End_Time"];
		$Start = Time1($Start);
		$End = Time1($End);
		/*
		echo statement allows for repetitive adding to table body to display entirety of week's schedule
		*/
		echo '					
				<tr>
					<td>'.$Start.'</td>
					<td>'.$End.'</td>
					<td>'.$row['Position'].'</td>
				</tr>';						
	} //end while
	/*
	echo statement closes both table body and table itself
	*/
	echo '
		</tbody>
		</table>
		';
} else {
	echo " 0 results";
}

//fucntions
function Time1(Int $Time){
	//Converts timestamp to human date and declare timezone
	$Time = "@".$Time;
	$dt = new DateTime($Time);
	$dt->setTimeZone(new DateTimeZone('America/New_York'));
	$cbt = $dt ->format('m/d/Y h:i a');
	return $cbt;
	;}

function getSchedID() {
	//This function returns the SchedID for the week
    date_default_timezone_set('America/New_York');
	
    $date = date("m/d/Y");
	
	//Had to add +3600 for timezone shit.
    $timestamp = strtotime($date)+3600;
    //Get the current number for the day of the week. For example Wednesday will be 3. Monday is 1 and
	// it is the start of the work week and it is SchedID.
	$day = date('w', $timestamp);
	//echo "the day is: " . $day;
    //Whatever day it is, subtract the days until it is the Monday of the work week. It is the SchedID
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