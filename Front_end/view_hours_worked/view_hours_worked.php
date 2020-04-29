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

$sql = "SELECT * FROM `worked` WHERE SchedID = $schedid and Employee_ID = $empID";
$result = $conn->query($sql);
	/*
	echo statement creates table, makes header for table, and starts the table body
	this allows for a static header but for body to be filled for entirety of schedule
	*/
	echo '
		<table class="table table-dark table-striped table-bordered">
			<thead style="font-size: 20px">Employee : '.$empID. '</thead>
				<thead>
					<tr>
						<th width="1%">Recorded Start</th>
						<th width="1%">Recorded End</th>
						<th width="1%">Hours Worked</th>
						<th width="1%">Late</th>
						<th width="1%">Scheduled</th>
						<th width="1%">Left Early</th>
					</tr>
				</thead>
				<tbody>
		';
if ($result->num_rows > 0) {


	// output data of each row
	while($row = $result->fetch_assoc()) {
		$Start = $row["Recorded_Start"];
		$End = $row["Recorded_End"];
		$Start = Time1($Start);
		$End = Time1($End);
		$hours_worked = gmdate("H:i:s", $row["Hours Worked"]);
		$late = convertBool($row["isLate"]);
		$isSched = convertBool($row["isSched"]);
		$leftEarly = convertBool($row["leftEarly"]);
		/*
		echo statement allows for repetitive adding to table body to display entirety of week's schedule
		*/
		echo '					
				<tr>
					<td>'.$Start.'</td>
					<td>'.$End.'</td>
					<td>'.$hours_worked.'</td>
					<td>'.$late.'</td>
					<td>'.$isSched.'</td>
					<td>'.$leftEarly.'</td>
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
	echo   ' <tr>  
             <td colspan="6">No Hours Recorded for this Week.</td>  
            </tr>
			</tbody>
			</table>' ;
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